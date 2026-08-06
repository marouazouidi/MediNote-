<?php

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can view their patient', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Sanctum::actingAs($user);

    $this->getJson("/api/patients/{$patient->id}")
        ->assertOk()
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
        ->assertJsonPath('data.id', $patient->id)
        ->assertJsonPath('data.first_name', $patient->first_name)
        ->assertJsonPath('data.gender', $patient->gender->value);
});

test('a guest cannot view a patient', function () {
    $patient = Patient::factory()->create();

    $this->getJson("/api/patients/{$patient->id}")
        ->assertUnauthorized();
});

test('a non owner receives 403 when viewing a patient', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $patient = Patient::factory()->for($owner)->create();

    Sanctum::actingAs($other);

    $this->getJson("/api/patients/{$patient->id}")
        ->assertForbidden();
});

test('viewing a missing patient returns 404', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/patients/99999')
        ->assertNotFound();
});
