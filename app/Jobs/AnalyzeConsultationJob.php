<?php

namespace App\Jobs;

use App\Enums\AnalysisStatusEnum;
use App\Models\TextBrut;
use App\Services\AiService;
use App\Services\TextBrutService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class AnalyzeConsultationJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public TextBrut $textBrut,
    ) {}

    public function handle(AiService $aiService, TextBrutService $textBrutService): void
    {
        try {
            $result = $aiService->analyze($this->textBrut);

            $textBrutService->markAsAnalyzed($this->textBrut, $result);
        } catch (\Throwable $e) {
            $this->textBrut->update(['analysis_status' => AnalysisStatusEnum::Failed]);

            throw $e;
        }
    }
}