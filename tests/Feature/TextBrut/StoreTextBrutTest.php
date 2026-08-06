<?php

use App\Models\Appointment;
use App\Models\TextBrut;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('a doctor can create a text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $appointment = Appointment::factory()->create();

    Sanctum::actingAs($doctor);

    $response = $this->postJson('/api/text-bruts', [
        'appointment_id' => $appointment->id,
        'content' => 'Patient presents with persistent headache and fever.',
    ]);

    $response
        ->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'id',
                'user_id',
                'appointment_id',
                'content',
                'analysis_status',
                'created_at',
                'updated_at',
            ],
        ])
        ->assertJsonPath('data.appointment_id', $appointment->id)
        ->assertJsonPath('data.content', 'Patient presents with persistent headache and fever.')
        ->assertJsonPath('data.analysis_status', 'pending')
        ->assertJsonPath('data.user_id', $doctor->id);

    $this->assertDatabaseHas('text_bruts', [
        'appointment_id' => $appointment->id,
        'user_id' => $doctor->id,
        'content' => 'Patient presents with persistent headache and fever.',
        'analysis_status' => 'pending',
    ]);
});

test('a guest cannot create a text brut', function () {
    $this->postJson('/api/text-bruts', [
        'appointment_id' => 1,
        'content' => 'Some content',
    ])
        ->assertUnauthorized();
});

test('an assistant cannot create a text brut', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $appointment = Appointment::factory()->create();

    Sanctum::actingAs($assistant);

    $this->postJson('/api/text-bruts', [
        'appointment_id' => $appointment->id,
        'content' => 'Some content',
    ])
        ->assertForbidden();
});

test('the appointment id is required', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    Sanctum::actingAs($doctor);

    $this->postJson('/api/text-bruts', [
        'content' => 'Some content',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('appointment_id');
});

test('the appointment id must exist', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    Sanctum::actingAs($doctor);

    $this->postJson('/api/text-bruts', [
        'appointment_id' => 99999,
        'content' => 'Some content',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('appointment_id');
});

test('the appointment id must be unique', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $appointment = Appointment::factory()->create();

    TextBrut::factory()->create(['appointment_id' => $appointment->id]);

    Sanctum::actingAs($doctor);

    $this->postJson('/api/text-bruts', [
        'appointment_id' => $appointment->id,
        'content' => 'Some content',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('appointment_id');
});

test('the content is required', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $appointment = Appointment::factory()->create();

    Sanctum::actingAs($doctor);

    $this->postJson('/api/text-bruts', [
        'appointment_id' => $appointment->id,
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('content');
});

test('the content must be a string', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $appointment = Appointment::factory()->create();

    Sanctum::actingAs($doctor);

    $this->postJson('/api/text-bruts', [
        'appointment_id' => $appointment->id,
        'content' => ['not', 'a', 'string'],
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('content');
});

test('the user id is automatically assigned from the authenticated doctor', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $appointment = Appointment::factory()->create();

    Sanctum::actingAs($doctor);

    $this->postJson('/api/text-bruts', [
        'appointment_id' => $appointment->id,
        'content' => 'Some content',
    ])
        ->assertCreated();

    $this->assertDatabaseHas('text_bruts', [
        'appointment_id' => $appointment->id,
        'user_id' => $doctor->id,
    ]);

    $this->assertDatabaseCount('text_bruts', 1);
});
