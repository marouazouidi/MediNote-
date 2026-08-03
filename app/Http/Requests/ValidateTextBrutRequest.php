<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class ValidateTextBrutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->role === RoleEnum::Doctor;
    }

    public function rules(): array
    {
        return [];
    }
}
