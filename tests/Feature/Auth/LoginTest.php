<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('can login with valid credentials', function () {

    $user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'password123',
    ]);

    $response
        ->assertOk()
        ->assertJsonStructure([
            'user',
            'token',
        ]);
});

test('cannot login with wrong password', function () {

    $user = User::factory()->create([
        'password' => Hash::make('password123'),
    ]);

    $response = $this->postJson('/api/login', [
        'email' => $user->email,
        'password' => 'wrongpassword',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

test('cannot login with unknown email', function () {

    $response = $this->postJson('/api/login', [
        'email' => 'unknown@example.com',
        'password' => 'password123',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

test('requires email', function () {

    $response = $this->postJson('/api/login', [
        'password' => 'password123',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

test('requires password', function () {

    $response = $this->postJson('/api/login', [
        'email' => 'maroua@example.com',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('password');
});

test('requires a valid email', function () {

    $response = $this->postJson('/api/login', [
        'email' => 'invalid-email',
        'password' => 'password123',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});
