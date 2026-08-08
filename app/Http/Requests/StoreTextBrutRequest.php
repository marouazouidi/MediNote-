<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreTextBrutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === RoleEnum::Doctor;
    }

    public function rules(): array
    {
        return [
            'appointment_id' => ['required', 'integer', 'exists:appointments,id', 'unique:text_bruts,appointment_id'],
            'content' => ['required', 'string'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'appointment_id' => [
                'description' => 'The identifier of the appointment this consultation note belongs to. Must be unique per text brut.',
                'example' => 1,
            ],
            'content' => [
                'description' => 'The free-text medical note written by the doctor during the consultation.',
                'example' => 'Patient presents with persistent headache and mild fever for the past two days.',
            ],
        ];
    }
}
