<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'email' => [
                'description' => 'The email address of the user.',
                'example' => 'doctor@example.com',
            ],
            'password' => [
                'description' => 'The user password.',
                'example' => 'password123',
            ],
        ];
    }
}
