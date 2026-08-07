<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'name' => [
                'description' => 'The full name of the user.',
                'example' => 'Dr. Jane Doe',
            ],
            'email' => [
                'description' => 'The email address of the user. Must be unique across the application.',
                'example' => 'doctor@example.com',
            ],
            'password' => [
                'description' => 'The user password. Must be at least 8 characters long.',
                'example' => 'password123',
            ],
        ];
    }
}
