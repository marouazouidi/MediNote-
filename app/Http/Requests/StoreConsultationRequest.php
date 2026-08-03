<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class StoreConsultationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === RoleEnum::Doctor;
    }

    public function rules(): array
    {
        return [
            'text_brut_id'    => ['required', 'integer', 'exists:text_bruts,id', 'unique:consultations,text_brut_id'],
            'chief_complaint' => ['required', 'string', 'max:255'],
            'symptoms'        => ['required', 'array'],
            'symptoms.*'      => ['string'],
            'observations'    => ['required', 'string'],
            'diagnosis'       => ['nullable', 'string', 'max:255'],
            'follow_up_date'  => ['nullable', 'date'],
            'validated_at'    => ['nullable', 'date'],
        ];
    }
}