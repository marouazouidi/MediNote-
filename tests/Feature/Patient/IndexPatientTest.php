<?php

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('an authenticated user can list their own patients', function () {
    $user = User::factory()->create();

    Patient::factory()->count(3)->for($user)->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/patients')
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
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
            ],
        ]);
});

test('a guest cannot list patients', function () {
    $this->getJson('/api/patients')
        ->assertUnauthorized();
});

test('a user cannot see another users patients', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    Patient::factory()->count(2)->for($owner)->create();
    $otherPatient = Patient::factory()->for($other)->create();

    Sanctum::actingAs($owner);

    $response = $this->getJson('/api/patients')
        ->assertOk()
        ->assertJsonCount(2, 'data');

    $patientIds = collect($response->json('data'))->pluck('id')->all();

    expect($patientIds)->not->toContain($otherPatient->id);
});

test('listing patients with an empty collection succeeds', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/patients')
        ->assertOk()
        ->assertJsonCount(0, 'data');
});
