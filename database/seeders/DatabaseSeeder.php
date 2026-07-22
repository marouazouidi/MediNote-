<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
    User::firstOrCreate(
        ['email' => 'doctor@medinote.com'],
        [
            'name' => 'Dr. Dupont',
            'password' => Hash::make('password'),
            'role' => RoleEnum::Doctor,
        ]
    );
    }
}
