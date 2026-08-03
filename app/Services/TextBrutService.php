<?php

namespace App\Services;

use App\AI\Schemas\AiAnalysisResult;
use App\Enums\AnalysisStatusEnum;
use App\Jobs\AnalyzeConsultationJob;
use App\Models\Consultation;
use App\Models\TextBrut;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TextBrutService
{
    public function __construct(
        protected AiResultStore $aiResultStore,
        protected ConsultationService $consultationService,
    ) {}

    public function store(array $data): TextBrut
    {
        $data['user_id'] ??= auth()->id();

        return TextBrut::create($data);
    }

    public function show(TextBrut $textBrut): TextBrut
    {
        return $textBrut->load(['appointment', 'doctor']);
    }

    public function update(TextBrut $textBrut, array $data): TextBrut
    {
        $textBrut->update($data);

        return $textBrut->load([
            'appointment', 'doctor',
        ]);
    }

    public function analyze(TextBrut $textBrut): void
    {
        if ($textBrut->analysis_status === AnalysisStatusEnum::Analyzed
            || $textBrut->analysis_status === AnalysisStatusEnum::Validated
        ) {
            throw ValidationException::withMessages([
                'analysis_status' => 'The AI analysis has already been completed.',
            ]);
        }

        $textBrut->update([
            'analysis_status' => AnalysisStatusEnum::Pending,
        ]);

        AnalyzeConsultationJob::dispatch($textBrut);
    }

    public function markAsAnalyzed(TextBrut $textBrut, AiAnalysisResult $result): void
    {
        $this->aiResultStore->put($textBrut, $result);

        $textBrut->update([
            'analysis_status' => AnalysisStatusEnum::Analyzed,
        ]);
    }

    public function markAsValidated(TextBrut $textBrut): void
    {
        $textBrut->update([
            'analysis_status' => AnalysisStatusEnum::Validated,
        ]);
    }

    public function validate(TextBrut $textBrut): Consultation
    {
        if ($textBrut->analysis_status !== AnalysisStatusEnum::Analyzed) {
            throw ValidationException::withMessages([
                'analysis_status' => 'The AI analysis has not finished yet.',
            ]);
        }

        $result = $this->aiResultStore->get($textBrut);

        if ($result === null) {
            throw ValidationException::withMessages([
                'ai_result' => 'No AI analysis result available for validation.',
            ]);
        }

        if ($textBrut->consultation()->exists()) {
            throw ValidationException::withMessages([
                'consultation' => 'A consultation already exists for this text.',
            ]);
        }

        return DB::transaction(function () use ($textBrut, $result) {
            $consultation = $this->consultationService->createFromValidatedAi($textBrut, $result);

            $this->markAsValidated($textBrut);
            $this->aiResultStore->forget($textBrut);

            return $consultation;
        });
    }
}
