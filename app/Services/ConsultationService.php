<?php

namespace App\Services;

use App\AI\Schemas\AiAnalysisResult;
use App\Models\Consultation;
use App\Models\TextBrut;

class ConsultationService
{
    public function index()
    {
        return Consultation::with(['textBrut', 'prescriptions'])
            ->whereHas('textBrut', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(5);
    }

    public function show(Consultation $consultation): Consultation
    {
        return $consultation->load(['textBrut', 'prescriptions']);
    }

    public function createFromValidatedAi(TextBrut $textBrut, AiAnalysisResult $result): Consultation
    {
        $consultation = Consultation::create([
            'text_brut_id' => $textBrut->id,
            'chief_complaint' => $result->chief_complaint,
            'symptoms' => $result->symptoms,
            'observations' => $result->observations,
            'diagnosis' => $result->diagnosis,
            'follow_up_date' => $result->follow_up_date,
            'validated_at' => now(),
        ]);

        foreach ($result->prescriptions as $prescription) {
            $consultation->prescriptions()->create([
                'medication_name' => $prescription->medication_name,
                'dosage' => $prescription->dosage,
                'frequency' => $prescription->frequency,
                'duration' => $prescription->duration,
                'instructions' => $prescription->instructions,
            ]);
        }

        return $consultation->load(['textBrut', 'prescriptions']);
    }
}
