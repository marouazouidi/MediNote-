<?php

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can delete their patient', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Sanctum::actingAs($user);

    $this->deleteJson("/api/patients/{$patient->id}")
        ->assertOk()
        ->assertJson(['message' => 'Patient deleted successfully']);
});

test('a guest cannot delete a patient', function () {
    $patient = Patient::factory()->create();

    $this->deleteJson("/api/patients/{$patient->id}")
        ->assertUnauthorized();
});

test('a non owner receives 403 when deleting a patient', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $patient = Patient::factory()->for($owner)->create();

    Sanctum::actingAs($other);

    $this->deleteJson("/api/patients/{$patient->id}")
        ->assertForbidden();
});

test('deleting a patient soft deletes the record', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Sanctum::actingAs($user);

    $this->deleteJson("/api/patients/{$patient->id}")
        ->assertOk();

    $this->assertSoftDeleted('patients', ['id' => $patient->id]);

    $this->assertDatabaseHas('patients', ['id' => $patient->id]);
});
