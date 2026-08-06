<?php

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can update their patient', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create(['first_name' => 'Old']);

    Sanctum::actingAs($user);

    $payload = [
        'first_name' => 'Updated',
        'last_name' => $patient->last_name,
        'birth_date' => $patient->birth_date->format('Y-m-d'),
        'gender' => $patient->gender->value,
        'phone' => $patient->phone,
        'address' => $patient->address,
        'allergies' => $patient->allergies,
    ];

    $this->putJson("/api/patients/{$patient->id}", $payload)
        ->assertOk()
        ->assertJsonPath('data.first_name', 'Updated');

    $this->assertDatabaseHas('patients', [
        'id' => $patient->id,
        'first_name' => 'Updated',
    ]);
});

test('a guest cannot update a patient', function () {
    $patient = Patient::factory()->create();

    $this->putJson("/api/patients/{$patient->id}", [
        'first_name' => 'Updated',
        'last_name' => $patient->last_name,
        'gender' => $patient->gender->value,
    ])
        ->assertUnauthorized();
});

test('a non owner receives 403 when updating a patient', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $patient = Patient::factory()->for($owner)->create();

    Sanctum::actingAs($other);

    $this->putJson("/api/patients/{$patient->id}", [
        'first_name' => 'Updated',
        'last_name' => $patient->last_name,
        'gender' => $patient->gender->value,
    ])
        ->assertForbidden();
});

test('an invalid update returns validation errors', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Sanctum::actingAs($user);

    $this->putJson("/api/patients/{$patient->id}", [
        'first_name' => '',
        'gender' => 'unknown',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['first_name', 'gender']);
});

test('updated values are persisted', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Sanctum::actingAs($user);

    $this->putJson("/api/patients/{$patient->id}", [
        'first_name' => 'Marie',
        'last_name' => 'Curie',
        'birth_date' => '1867-11-07',
        'gender' => 'female',
        'phone' => '+33123456789',
        'address' => 'Paris',
        'allergies' => 'Pollen',
    ])
        ->assertOk();

    $this->assertDatabaseHas('patients', [
        'id' => $patient->id,
        'first_name' => 'Marie',
        'last_name' => 'Curie',
        'gender' => 'female',
        'phone' => '+33123456789',
        'address' => 'Paris',
        'allergies' => 'Pollen',
    ]);

    expect($patient->fresh()->birth_date->format('Y-m-d'))->toBe('1867-11-07');

    $this->assertDatabaseMissing('patients', [
        'id' => $patient->id,
        'first_name' => $patient->first_name,
    ]);
});
