<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['nullable', 'integer', 'exists:patients,id'],
            'appointment_date' => ['nullable', 'date'],
            'appointment_time' => ['nullable', 'date_format:H:i'],
            'reason' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:scheduled,completed,cancelled'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'patient_id' => [
                'description' => 'The updated identifier of the patient. This field is nullable.',
                'example' => 1,
            ],
            'appointment_date' => [
                'description' => 'The updated date of the appointment. This field is nullable.',
                'example' => '2026-09-15',
            ],
            'appointment_time' => [
                'description' => 'The updated time of the appointment in 24-hour format (HH:MM). This field is nullable.',
                'example' => '10:30',
            ],
            'reason' => [
                'description' => 'The updated reason or purpose of the appointment. This field is nullable.',
                'example' => 'Follow-up consultation',
            ],
            'status' => [
                'description' => 'The updated status of the appointment. Must be one of: scheduled, completed, cancelled. This field is nullable.',
                'example' => 'completed',
            ],
        ];
    }
}
