<?php

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can delete their appointment', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($user);

    $this->deleteJson("/api/appointments/{$appointment->id}")
        ->assertOk()
        ->assertJson(['message' => 'Appointment cancelled successfully']);
});

test('a guest cannot delete an appointment', function () {
    $appointment = Appointment::factory()->create();

    $this->deleteJson("/api/appointments/{$appointment->id}")
        ->assertUnauthorized();
});

test('a non owner receives 403 when deleting an appointment', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $patient = Patient::factory()->for($owner)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($other);

    $this->deleteJson("/api/appointments/{$appointment->id}")
        ->assertForbidden();
});

test('deleting an appointment soft deletes the record', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($user);

    $this->deleteJson("/api/appointments/{$appointment->id}")
        ->assertOk();

    $this->assertSoftDeleted('appointments', ['id' => $appointment->id]);

    $this->assertDatabaseHas('appointments', ['id' => $appointment->id]);
});
