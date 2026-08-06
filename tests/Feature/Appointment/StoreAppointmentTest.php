<?php

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('an authenticated user can create an appointment', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/appointments', [
        'patient_id' => $patient->id,
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
        'status' => 'scheduled',
    ]);

    $response
        ->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'id',
                'patient_id',
                'appointment_date',
                'appointment_time',
                'reason',
                'status',
                'created_at',
                'updated_at',
            ],
        ])
        ->assertJsonPath('data.patient_id', $patient->id)
        ->assertJsonPath('data.appointment_time', '14:30')
        ->assertJsonPath('data.reason', 'Annual check-up')
        ->assertJsonPath('data.status', 'scheduled');

    $this->assertDatabaseHas('appointments', [
        'patient_id' => $patient->id,
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
        'status' => 'scheduled',
    ]);
});

test('an appointment defaults to the scheduled status', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => $patient->id,
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
    ])
        ->assertCreated()
        ->assertJsonPath('data.status', 'scheduled');

    $this->assertDatabaseHas('appointments', [
        'patient_id' => $patient->id,
        'status' => 'scheduled',
    ]);
});

test('a guest cannot create an appointment', function () {
    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
    ])
        ->assertUnauthorized();
});

test('the patient id is required', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('patient_id');
});

test('the patient id must exist', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => 99999,
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('patient_id');
});

test('the appointment date is required', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('appointment_date');
});

test('the appointment date must be a valid date', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_date' => 'not-a-date',
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('appointment_date');
});

test('the appointment time is required', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_date' => '2026-08-10',
        'reason' => 'Annual check-up',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('appointment_time');
});

test('the appointment time must use the H:i format', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30:00',
        'reason' => 'Annual check-up',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('appointment_time');
});

test('the reason is required', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('reason');
});

test('the reason must not exceed 255 characters', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30',
        'reason' => str_repeat('a', 256),
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('reason');
});

test('the status accepts only scheduled, completed or cancelled', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_date' => '2026-08-10',
        'appointment_time' => '14:30',
        'reason' => 'Annual check-up',
        'status' => 'archived',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('status');
});
