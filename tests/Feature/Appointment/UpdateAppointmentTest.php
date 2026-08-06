<?php

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can update their appointment', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();
    $appointment = Appointment::factory()->for($patient)->create(['reason' => 'Old reason']);

    Sanctum::actingAs($user);

    $this->putJson("/api/appointments/{$appointment->id}", [
        'patient_id' => $patient->id,
        'appointment_date' => '2026-09-01',
        'appointment_time' => '09:00',
        'reason' => 'Updated reason',
        'status' => 'completed',
    ])
        ->assertOk()
        ->assertJsonPath('data.reason', 'Updated reason')
        ->assertJsonPath('data.appointment_time', '09:00')
        ->assertJsonPath('data.status', 'completed');

    $this->assertDatabaseHas('appointments', [
        'id' => $appointment->id,
        'appointment_time' => '09:00',
        'reason' => 'Updated reason',
        'status' => 'completed',
    ]);

    expect($appointment->fresh()->appointment_date->format('Y-m-d'))->toBe('2026-09-01');
});

test('a guest cannot update an appointment', function () {
    $appointment = Appointment::factory()->create();

    $this->putJson("/api/appointments/{$appointment->id}", [
        'reason' => 'Updated reason',
    ])
        ->assertUnauthorized();
});

test('a non owner receives 403 when updating an appointment', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $patient = Patient::factory()->for($owner)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($other);

    $this->putJson("/api/appointments/{$appointment->id}", [
        'reason' => 'Updated reason',
    ])
        ->assertForbidden();
});

test('an invalid update returns validation errors', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($user);

    $this->putJson("/api/appointments/{$appointment->id}", [
        'appointment_time' => 'invalid',
        'status' => 'archived',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors(['appointment_time', 'status']);
});

test('a partial update only modifies the provided fields', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();
    $appointment = Appointment::factory()->for($patient)->create([
        'reason' => 'Original reason',
        'status' => 'scheduled',
    ]);

    Sanctum::actingAs($user);

    $this->putJson("/api/appointments/{$appointment->id}", [
        'status' => 'cancelled',
    ])
        ->assertOk()
        ->assertJsonPath('data.status', 'cancelled')
        ->assertJsonPath('data.reason', 'Original reason');

    $this->assertDatabaseHas('appointments', [
        'id' => $appointment->id,
        'reason' => 'Original reason',
        'status' => 'cancelled',
    ]);
});

test('updated values are persisted', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($user);

    $this->putJson("/api/appointments/{$appointment->id}", [
        'patient_id' => $patient->id,
        'appointment_date' => '2026-10-15',
        'appointment_time' => '16:45',
        'reason' => 'Follow-up visit',
        'status' => 'completed',
    ])
        ->assertOk();

    $this->assertDatabaseHas('appointments', [
        'id' => $appointment->id,
        'appointment_time' => '16:45',
        'reason' => 'Follow-up visit',
        'status' => 'completed',
    ]);

    expect($appointment->fresh()->appointment_date->format('Y-m-d'))->toBe('2026-10-15');

    $this->assertDatabaseMissing('appointments', [
        'id' => $appointment->id,
        'reason' => $appointment->reason,
    ]);
});
