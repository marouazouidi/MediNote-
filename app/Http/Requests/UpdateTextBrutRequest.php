<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTextBrutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === RoleEnum::Doctor;
    }

    public function rules(): array
    {
        return [
            'content' => ['nullable', 'string'],
        ];
    }

    public function bodyParameters(): array
    {
        return [
            'content' => [
                'description' => 'The updated free-text medical note. This field is nullable.',
                'example' => 'Updated note: patient reports improved symptoms after medication.',
            ],
        ];
    }
}
