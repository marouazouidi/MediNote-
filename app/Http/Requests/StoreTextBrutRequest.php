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
            'content'        => ['required', 'string'],
        ];
    }
}
