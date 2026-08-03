<?php

namespace App\AI\Schemas;

class AiPrescriptionData
{
    public function __construct(
        public readonly string $medication_name,
        public readonly ?string $dosage = null,
        public readonly ?string $frequency = null,
        public readonly ?string $duration = null,
        public readonly ?string $instructions = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            medication_name: $data['medication_name'],
            dosage: $data['dosage'] ?? null,
            frequency: $data['frequency'] ?? null,
            duration: $data['duration'] ?? null,
            instructions: $data['instructions'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'medication_name' => $this->medication_name,
            'dosage' => $this->dosage,
            'frequency' => $this->frequency,
            'duration' => $this->duration,
            'instructions' => $this->instructions,
        ];
    }
}
