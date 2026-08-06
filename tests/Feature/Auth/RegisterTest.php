<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('can register a new user', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Maroua',
        'email' => 'maroua@example.com',
        'password' => 'password123',
    ]);

    $response
        ->assertCreated()
        ->assertJsonStructure([
            'user' => [
                'id',
                'name',
                'email',
            ],
            'token',
        ]);

    $this->assertDatabaseHas('users', [
        'email' => 'maroua@example.com',
    ]);
});

test('cannot register with existing email', function () {

    User::factory()->create([
        'email' => 'maroua@example.com',
    ]);

    $response = $this->postJson('/api/register', [
        'name' => 'Maroua',
        'email' => 'maroua@example.com',
        'password' => 'password123',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

test('requires a name', function () {

    $response = $this->postJson('/api/register', [
        'email' => 'maroua@example.com',
        'password' => 'password123',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('name');
});

test('requires an email', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Maroua',
        'password' => 'password123',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

test('requires a valid email', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Maroua',
        'email' => 'invalid-email',
        'password' => 'password123',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('email');
});

test('requires a password of at least eight characters', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Maroua',
        'email' => 'maroua@example.com',
        'password' => '123',
    ]);

    $response
        ->assertStatus(422)
        ->assertJsonValidationErrors('password');
});
