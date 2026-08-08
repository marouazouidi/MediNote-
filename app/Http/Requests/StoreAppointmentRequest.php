<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'appointment_date' => ['required', 'date'],
            'appointment_time' => ['required', 'date_format:H:i'],
            'reason' => ['required', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'in:scheduled,completed,cancelled'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'patient_id' => [
                'description' => 'The identifier of the patient this appointment is scheduled for.',
                'example' => 1,
            ],
            'appointment_date' => [
                'description' => 'The date of the appointment.',
                'example' => '2026-09-15',
            ],
            'appointment_time' => [
                'description' => 'The time of the appointment in 24-hour format (HH:MM).',
                'example' => '10:30',
            ],
            'reason' => [
                'description' => 'The reason or purpose of the appointment.',
                'example' => 'Annual medical check-up',
            ],
            'status' => [
                'description' => 'The status of the appointment. Must be one of: scheduled, completed, cancelled. This field is nullable.',
                'example' => 'scheduled',
            ],
        ];
    }
}
