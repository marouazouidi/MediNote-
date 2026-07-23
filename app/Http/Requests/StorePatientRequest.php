<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name'   => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'birth_date'   => ['nullable', 'date'],
            'gender'       => ['required', 'string', 'in:male,female'],
            'phone'        => ['nullable', 'string', 'max:20'],
            'address'      => ['nullable', 'string'],
            'allergies'    => ['nullable', 'string'],
        ];
    }
}
