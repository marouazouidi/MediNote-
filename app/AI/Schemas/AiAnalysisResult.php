<?php

namespace App\AI\Schemas;

class AiAnalysisResult
{
    public function __construct(
        public readonly string $chief_complaint,
        public readonly array $symptoms,
        public readonly string $observations,
        public readonly ?string $diagnosis = null,
        public readonly ?string $follow_up_date = null,
        public readonly array $prescriptions = [],
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            chief_complaint: $data['chief_complaint'],
            symptoms: $data['symptoms'],
            observations: $data['observations'],
            diagnosis: $data['diagnosis'] ?? null,
            follow_up_date: $data['follow_up_date'] ?? null,
            prescriptions: array_map(
                fn (array $prescription) => AiPrescriptionData::fromArray($prescription),
                $data['prescriptions'] ?? [],
            ),
        );
    }

    public function toArray(): array
    {
        return [
            'chief_complaint' => $this->chief_complaint,
            'symptoms' => $this->symptoms,
            'observations' => $this->observations,
            'diagnosis' => $this->diagnosis,
            'follow_up_date' => $this->follow_up_date,
            'prescriptions' => array_map(
                fn (AiPrescriptionData $prescription) => $prescription->toArray(),
                $this->prescriptions,
            ),
        ];
    }
}
