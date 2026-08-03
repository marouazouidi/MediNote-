<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\TextBrut;
use App\Models\User;

class TextBrutPolicy
{
    public function analyze(User $user, TextBrut $textBrut): bool
    {
        return $user->role === RoleEnum::Doctor;
    }

    public function validate(User $user, TextBrut $textBrut): bool
    {
        return $user->role === RoleEnum::Doctor;
    }
}
