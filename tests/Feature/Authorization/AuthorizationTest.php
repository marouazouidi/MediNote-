<?php

use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Patient;
use App\Models\TextBrut;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

// ---------------------------------------------------------------------------
// Guests must receive 401 from every protected endpoint.
// ---------------------------------------------------------------------------

test('a guest cannot list patients', function () {
    $this->getJson('/api/patients')->assertUnauthorized();
});

test('a guest cannot search patients', function () {
    $this->getJson('/api/patients/search?q=John')->assertUnauthorized();
});

test('a guest cannot create a patient', function () {
    $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'gender' => 'female',
    ])->assertUnauthorized();
});

test('a guest cannot view a patient', function () {
    $patient = Patient::factory()->create();

    $this->getJson("/api/patients/{$patient->id}")->assertUnauthorized();
});

test('a guest cannot update a patient', function () {
    $patient = Patient::factory()->create();

    $this->putJson("/api/patients/{$patient->id}", [
        'first_name' => 'Updated',
        'last_name' => 'Name',
        'gender' => 'female',
    ])->assertUnauthorized();
});

test('a guest cannot delete a patient', function () {
    $patient = Patient::factory()->create();

    $this->deleteJson("/api/patients/{$patient->id}")->assertUnauthorized();
});

test('a guest cannot list appointments', function () {
    $this->getJson('/api/appointments')->assertUnauthorized();
});

test('a guest cannot create an appointment', function () {
    $this->postJson('/api/appointments', [
        'patient_id' => 1,
        'appointment_date' => '2026-09-01',
        'appointment_time' => '10:00',
        'reason' => 'Check-up',
    ])->assertUnauthorized();
});

test('a guest cannot view an appointment', function () {
    $appointment = Appointment::factory()->create();

    $this->getJson("/api/appointments/{$appointment->id}")->assertUnauthorized();
});

test('a guest cannot update an appointment', function () {
    $appointment = Appointment::factory()->create();

    $this->putJson("/api/appointments/{$appointment->id}", [
        'reason' => 'Updated reason',
    ])->assertUnauthorized();
});

test('a guest cannot delete an appointment', function () {
    $appointment = Appointment::factory()->create();

    $this->deleteJson("/api/appointments/{$appointment->id}")->assertUnauthorized();
});

test('a guest cannot create a text brut', function () {
    $this->postJson('/api/text-bruts', [
        'appointment_id' => 1,
        'content' => 'Some note',
    ])->assertUnauthorized();
});

test('a guest cannot view a text brut', function () {
    $textBrut = TextBrut::factory()->create();

    $this->getJson("/api/text-bruts/{$textBrut->id}")->assertUnauthorized();
});

test('a guest cannot update a text brut', function () {
    $textBrut = TextBrut::factory()->create();

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated note',
    ])->assertUnauthorized();
});

test('a guest cannot analyze a text brut', function () {
    $textBrut = TextBrut::factory()->create();

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")->assertUnauthorized();
});

test('a guest cannot validate a text brut', function () {
    $textBrut = TextBrut::factory()->create();

    $this->postJson("/api/text-bruts/{$textBrut->id}/validate")->assertUnauthorized();
});

test('a guest cannot list consultations', function () {
    $this->getJson('/api/consultations')->assertUnauthorized();
});

test('a guest cannot view a consultation', function () {
    $consultation = Consultation::factory()->create();

    $this->getJson("/api/consultations/{$consultation->id}")->assertUnauthorized();
});

// ---------------------------------------------------------------------------
// Patients: viewAny and create are open to any authenticated user.
// view/update/delete are restricted to the owner.
// ---------------------------------------------------------------------------

test('an authenticated assistant can list patients', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    Sanctum::actingAs($assistant);

    $this->getJson('/api/patients')->assertOk();
});

test('an authenticated user can create a patient', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    Sanctum::actingAs($assistant);

    $this->postJson('/api/patients', [
        'first_name' => 'Jane',
        'last_name' => 'Doe',
        'gender' => 'female',
    ])->assertCreated();
});

test('the owner can view their patient', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($doctor)->create();

    Sanctum::actingAs($doctor);

    $this->getJson("/api/patients/{$patient->id}")->assertOk();
});

test('a non owner cannot view a patient', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($owner)->create();

    Sanctum::actingAs($other);

    $this->getJson("/api/patients/{$patient->id}")->assertForbidden();
});

test('the owner can update their patient', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($doctor)->create();

    Sanctum::actingAs($doctor);

    $this->putJson("/api/patients/{$patient->id}", [
        'first_name' => 'Updated',
        'last_name' => $patient->last_name,
        'gender' => $patient->gender->value,
    ])->assertOk();
});

test('a non owner cannot update a patient', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($owner)->create();

    Sanctum::actingAs($other);

    $this->putJson("/api/patients/{$patient->id}", [
        'first_name' => 'Updated',
        'last_name' => $patient->last_name,
        'gender' => $patient->gender->value,
    ])->assertForbidden();
});

test('the owner can delete their patient', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($doctor)->create();

    Sanctum::actingAs($doctor);

    $this->deleteJson("/api/patients/{$patient->id}")->assertOk();
});

test('a non owner cannot delete a patient', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($owner)->create();

    Sanctum::actingAs($other);

    $this->deleteJson("/api/patients/{$patient->id}")->assertForbidden();
});

// ---------------------------------------------------------------------------
// Appointments: viewAny and create are open to any authenticated user.
// view/update/delete are restricted to the owner of the parent patient.
// ---------------------------------------------------------------------------

test('an authenticated assistant can list appointments', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    Sanctum::actingAs($assistant);

    $this->getJson('/api/appointments')->assertOk();
});

test('an authenticated user can create an appointment', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $patient = Patient::factory()->create();

    Sanctum::actingAs($assistant);

    $this->postJson('/api/appointments', [
        'patient_id' => $patient->id,
        'appointment_date' => '2026-09-01',
        'appointment_time' => '10:00',
        'reason' => 'Check-up',
    ])->assertCreated();
});

test('the owner can view their appointment', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($doctor)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($doctor);

    $this->getJson("/api/appointments/{$appointment->id}")->assertOk();
});

test('a non owner cannot view an appointment', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($owner)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($other);

    $this->getJson("/api/appointments/{$appointment->id}")->assertForbidden();
});

test('the owner can update their appointment', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($doctor)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($doctor);

    $this->putJson("/api/appointments/{$appointment->id}", [
        'reason' => 'Updated reason',
    ])->assertOk();
});

test('a non owner cannot update an appointment', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($owner)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($other);

    $this->putJson("/api/appointments/{$appointment->id}", [
        'reason' => 'Updated reason',
    ])->assertForbidden();
});

test('the owner can delete their appointment', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($doctor)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($doctor);

    $this->deleteJson("/api/appointments/{$appointment->id}")->assertOk();
});

test('a non owner cannot delete an appointment', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $patient = Patient::factory()->for($owner)->create();
    $appointment = Appointment::factory()->for($patient)->create();

    Sanctum::actingAs($other);

    $this->deleteJson("/api/appointments/{$appointment->id}")->assertForbidden();
});

// ---------------------------------------------------------------------------
// TextBruts: create/analyze/validate are restricted to doctors.
// view/update are restricted to the owner (who is always a doctor).
// ---------------------------------------------------------------------------

test('a doctor can create a text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $appointment = Appointment::factory()->create();

    Sanctum::actingAs($doctor);

    $this->postJson('/api/text-bruts', [
        'appointment_id' => $appointment->id,
        'content' => 'Patient presents with a persistent cough.',
    ])->assertCreated();
});

test('an assistant cannot create a text brut', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $appointment = Appointment::factory()->create();

    Sanctum::actingAs($assistant);

    $this->postJson('/api/text-bruts', [
        'appointment_id' => $appointment->id,
        'content' => 'Patient presents with a persistent cough.',
    ])->assertForbidden();
});

test('the owner doctor can view their text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();

    Sanctum::actingAs($doctor);

    $this->getJson("/api/text-bruts/{$textBrut->id}")->assertOk();
});

test('a non owner doctor cannot view a text brut', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($owner, 'doctor')->create();

    Sanctum::actingAs($other);

    $this->getJson("/api/text-bruts/{$textBrut->id}")->assertForbidden();
});

test('the owner doctor can update their text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();

    Sanctum::actingAs($doctor);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated clinical note.',
    ])->assertOk();
});

test('a non owner doctor cannot update a text brut', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($owner, 'doctor')->create();

    Sanctum::actingAs($other);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated clinical note.',
    ])->assertForbidden();
});

test('an assistant cannot update a text brut', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $textBrut = TextBrut::factory()->create();

    Sanctum::actingAs($assistant);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated clinical note.',
    ])->assertForbidden();
});

test('a doctor can trigger the analysis of a text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();

    Queue::fake();

    Sanctum::actingAs($doctor);

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")->assertAccepted();
});

test('an assistant cannot trigger the analysis of a text brut', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $textBrut = TextBrut::factory()->create();

    Sanctum::actingAs($assistant);

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")->assertForbidden();
});

test('a doctor passes authorization to validate a text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();

    Sanctum::actingAs($doctor);

    $response = $this->postJson("/api/text-bruts/{$textBrut->id}/validate");

    expect($response->status())->not->toBe(403);
});

test('an assistant cannot validate a text brut', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $textBrut = TextBrut::factory()->create();

    Sanctum::actingAs($assistant);

    $this->postJson("/api/text-bruts/{$textBrut->id}/validate")->assertForbidden();
});

// ---------------------------------------------------------------------------
// Consultations: viewAny is open to any authenticated user.
// view is restricted to the owner of the parent text brut.
// ---------------------------------------------------------------------------

test('an authenticated assistant can list consultations', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    Sanctum::actingAs($assistant);

    $this->getJson('/api/consultations')->assertOk();
});

test('the owner doctor can view their consultation', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $consultation = Consultation::factory()->for($textBrut)->create();

    Sanctum::actingAs($doctor);

    $this->getJson("/api/consultations/{$consultation->id}")->assertOk();
});

test('a non owner doctor cannot view a consultation', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($owner, 'doctor')->create();
    $consultation = Consultation::factory()->for($textBrut)->create();

    Sanctum::actingAs($other);

    $this->getJson("/api/consultations/{$consultation->id}")->assertForbidden();
});
