<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTextBrutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'appointment_id' => ['nullable', 'integer', 'exists:appointments,id', 'unique:text_bruts,appointment_id,' . $this->route('text_brut')],
            'content'        => ['nullable', 'string'],
        ];
    }
}
