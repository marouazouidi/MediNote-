<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('an authenticated user can create a patient', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'birth_date' => '1990-05-15',
        'gender' => 'female',
        'phone' => '+15551234567',
        'address' => '123 Main Street',
        'allergies' => 'Penicillin',
    ]);

    $response
        ->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'id',
                'first_name',
                'last_name',
                'birth_date',
                'gender',
                'phone',
                'address',
                'allergies',
                'created_at',
                'updated_at',
            ],
        ])
        ->assertJsonPath('data.first_name', 'Jane')
        ->assertJsonPath('data.gender', 'female');

    $this->assertDatabaseHas('patients', [
        'user_id' => $user->id,
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'gender' => 'female',
    ]);
});

test('a guest cannot create a patient', function () {
    $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'gender' => 'female',
    ])
        ->assertUnauthorized();
});

test('the first name is required', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/patients', [
        'last_name' => 'Doe',
        'gender' => 'female',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('first_name');
});

test('the last name is required', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'gender' => 'female',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('last_name');
});

test('the gender is required', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('gender');
});

test('the gender accepts only male or female', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'gender' => 'unknown',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('gender');
});

test('the birth date must be a valid date', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'gender' => 'female',
        'birth_date' => 'not-a-date',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('birth_date');
});

test('the user id is automatically assigned from the authenticated user', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'gender' => 'female',
    ])
        ->assertCreated();

    $this->assertDatabaseHas('patients', [
        'user_id' => $user->id,
        'first_name' => 'Jane',
    ]);

    $this->assertDatabaseCount('patients', 1);
});
