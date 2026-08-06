<?php

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('an authenticated user can list appointments', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Appointment::factory()->count(3)->for($patient)->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/appointments')
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'patient_id',
                    'appointment_date',
                    'appointment_time',
                    'reason',
                    'status',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
});

test('a guest cannot list appointments', function () {
    $this->getJson('/api/appointments')
        ->assertUnauthorized();
});

test('a user cannot see another users appointments', function () {
    $owner = User::factory()->create();
    $other = User::factory()->create();

    $ownerPatient = Patient::factory()->for($owner)->create();
    Appointment::factory()->count(2)->for($ownerPatient)->create();

    $otherPatient = Patient::factory()->for($other)->create();
    $otherAppointment = Appointment::factory()->for($otherPatient)->create();

    Sanctum::actingAs($owner);

    $response = $this->getJson('/api/appointments')
        ->assertOk()
        ->assertJsonCount(2, 'data');

    $appointmentIds = collect($response->json('data'))->pluck('id')->all();

    expect($appointmentIds)->not->toContain($otherAppointment->id);
});

test('listing appointments with an empty collection succeeds', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/appointments')
        ->assertOk()
        ->assertJsonCount(0, 'data');
});

test('appointments are paginated', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Appointment::factory()->count(16)->for($patient)->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/appointments')
        ->assertOk()
        ->assertJsonCount(15, 'data')
        ->assertJsonPath('meta.total', 16);

    $this->getJson('/api/appointments?page=2')
        ->assertOk()
        ->assertJsonCount(1, 'data');
});

test('appointments can be filtered by status', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Appointment::factory()->for($patient)->create(['status' => 'cancelled']);
    Appointment::factory()->for($patient)->create(['status' => 'completed']);

    Sanctum::actingAs($user);

    $this->getJson('/api/appointments?status=cancelled')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.status', 'cancelled');
});

test('appointments can be filtered by date range', function () {
    $user = User::factory()->create();

    $patient = Patient::factory()->for($user)->create();

    Appointment::factory()->for($patient)->create(['appointment_date' => '2026-08-01']);
    $appointment = Appointment::factory()->for($patient)->create(['appointment_date' => '2026-08-10']);

    Sanctum::actingAs($user);

    $this->getJson('/api/appointments?date_from=2026-08-05&date_to=2026-08-15')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.id', $appointment->id);
});
