<?php

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can view their appointment', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($user);

    $this->getJson("/api/appointments/{$appointment->id}")
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'patient_id',
                'patient' => [
                    'id',
                    'first_name',
                    'last_name',
                ],
                'appointment_date',
                'appointment_time',
                'reason',
                'status',
                'created_at',
                'updated_at',
            ],
        ])
        ->assertJsonPath('data.id', $appointment->id)
        ->assertJsonPath('data.patient_id', $patient->id)
        ->assertJsonPath('data.reason', $appointment->reason)
        ->assertJsonPath('data.status', $appointment->status->value)
        ->assertJsonPath('data.patient.id', $patient->id);
});

test('a guest cannot view an appointment', function () {
    $appointment = Appointment::factory()->create();

    $this->getJson("/api/appointments/{$appointment->id}")
        ->assertUnauthorized();
});

test('a non owner receives 403 when viewing an appointment', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $patient = Patient::factory()->for($owner)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($other);

    $this->getJson("/api/appointments/{$appointment->id}")
        ->assertForbidden();
});

test('viewing a missing appointment returns 404', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/appointments/99999')
        ->assertNotFound();
});
