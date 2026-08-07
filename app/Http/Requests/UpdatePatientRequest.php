<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
                'description' => 'The updated first name of the patient.',
                'example' => 'Marie',
            ],
            'last_name' => [
                'description' => 'The updated last name of the patient.',
                'example' => 'Curie',
            ],
            'birth_date' => [
                'description' => 'The updated birth date of the patient. This field is nullable.',
                'example' => '1990-05-15',
            ],
            'gender' => ['description' => 'The updated gender of the patient. Must be one of: male, female.', 'example' => 'female'],
            'phone' => [
                'description' => 'The updated phone number of the patient. This field is nullable.',
                'example' => '+33612345678',
            ],
            'address' => [
                'description' => 'The updated home address of the patient. This field is nullable.',
                'example' => '12 Rue de la Paix, Paris',
            ],
            'allergies' => [
                'description' => 'The updated description of the patient\'s known allergies. This field is nullable.',
                'example' => 'Penicillin',
            ],
        ];
    }
}
