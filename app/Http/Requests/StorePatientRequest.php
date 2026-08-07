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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['required', 'string', 'in:male,female'],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'allergies' => ['nullable', 'string'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'first_name' => [
                'description' => 'The first name of the patient.',
                'example' => 'Marie',
            ],
            'last_name' => [
                'description' => 'The last name of the patient.',
                'example' => 'Curie',
            ],
            'birth_date' => [
                'description' => 'The birth date of the patient. This field is nullable.',
                'example' => '1990-05-15',
            ],
            'gender' => ['description' => 'The gender of the patient. Must be one of: male, female.', 'example' => 'female'],
            'phone' => [
                'description' => 'The phone number of the patient. This field is nullable.',
                'example' => '+33612345678',
            ],
            'address' => [
                'description' => 'The home address of the patient. This field is nullable.',
                'example' => '12 Rue de la Paix, Paris',
            ],
            'allergies' => [
                'description' => 'A description of the patient\'s known allergies. This field is nullable.',
                'example' => 'Penicillin',
            ],
        ];
    }
}
