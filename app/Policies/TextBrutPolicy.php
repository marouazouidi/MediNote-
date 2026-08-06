<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\TextBrut;
use App\Models\User;

class TextBrutPolicy
{
    public function create(User $user): bool
    {
        return $user->role === RoleEnum::Doctor;
    }

    public function view(User $user, TextBrut $textBrut): bool
    {
        return $textBrut->user_id === $user->id;
    }

    public function update(User $user, TextBrut $textBrut): bool
    {
        return $user->role === RoleEnum::Doctor && $textBrut->user_id === $user->id;
    }

    public function analyze(User $user, TextBrut $textBrut): bool
    {
        return $user->role === RoleEnum::Doctor;
    }

    public function validate(User $user, TextBrut $textBrut): bool
    {
        return $user->role === RoleEnum::Doctor;
    }
}
