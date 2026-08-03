<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConsultationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === RoleEnum::Doctor;
    }

    public function rules(): array
    {
        return [
            'chief_complaint' => ['nullable', 'string', 'max:255'],
            'symptoms'        => ['nullable', 'array'],
            'symptoms.*'      => ['string'],
            'observations'    => ['nullable', 'string'],
            'diagnosis'       => ['nullable', 'string', 'max:255'],
            'follow_up_date'  => ['nullable', 'date'],
            'validated_at'    => ['nullable', 'date'],
        ];
    }
}