<?php

namespace App\AI\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Promptable;
use Stringable;

class ConsultationAnalysisAgent implements Agent, Conversational, HasStructuredOutput, HasTools
{
    use Promptable;

    public function instructions(): Stringable|string
    {
        return <<<'PROMPT'
            You are a medical analysis assistant. Your role is to analyze free-text consultation notes written by a doctor and extract structured medical information.

            Analyze the provided consultation note and extract the following:
            1. Chief complaint (motif de consultation)
            2. Symptoms reported by the patient
            3. Clinical observations made by the doctor
            4. Diagnosis (if mentioned)
            5. Follow-up date (if mentioned, use YYYY-MM-DD format)
            6. Prescriptions (medication name, dosage, frequency, duration, and any special instructions)

            Return ONLY the structured JSON following the schema exactly.
            Do not add explanations, markdown formatting, or any text outside the JSON object.
            If information is not present in the note, use null for optional fields.
            PROMPT;
    }

    public function messages(): iterable
    {
        return [];
    }

    public function tools(): iterable
    {
        return [];
    }

    public function schema(JsonSchema $schema): array
    {
        return [
            'chief_complaint' => $schema->string()->required(),
            'symptoms' => $schema->array()->items($schema->string())->required(),
            'observations' => $schema->string()->required(),
            'diagnosis' => $schema->string()->nullable(),
            'follow_up_date' => $schema->string()->nullable(),
            'prescriptions' => $schema->array()->items(
                $schema->object([
                    'medication_name' => $schema->string()->required(),
                    'dosage' => $schema->string()->nullable(),
                    'frequency' => $schema->string()->nullable(),
                    'duration' => $schema->string()->nullable(),
                    'instructions' => $schema->string()->nullable(),
                ])
            )->required(),
        ];
    }
}
