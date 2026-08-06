<?php

use App\Models\Appointment;
use App\Models\TextBrut;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can view their text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $appointment = Appointment::factory()->create();
    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->for($appointment)->create();

    Sanctum::actingAs($doctor);

    $this->getJson("/api/text-bruts/{$textBrut->id}")
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'user_id',
                'doctor' => [
                    'id',
                    'name',
                    'email',
                    'role',
                ],
                'appointment_id',
                'appointment' => [
                    'id',
                    'patient_id',
                    'reason',
                ],
                'content',
                'analysis_status',
                'created_at',
                'updated_at',
            ],
        ])
        ->assertJsonPath('data.id', $textBrut->id)
        ->assertJsonPath('data.content', $textBrut->content)
        ->assertJsonPath('data.analysis_status', 'pending')
        ->assertJsonPath('data.user_id', $doctor->id)
        ->assertJsonPath('data.doctor.id', $doctor->id)
        ->assertJsonPath('data.appointment.id', $appointment->id);
});

test('a guest cannot view a text brut', function () {
    $textBrut = TextBrut::factory()->create();

    $this->getJson("/api/text-bruts/{$textBrut->id}")
        ->assertUnauthorized();
});

test('a non owner receives 403 when viewing a text brut', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($owner, 'doctor')->create();

    Sanctum::actingAs($other);

    $this->getJson("/api/text-bruts/{$textBrut->id}")
        ->assertForbidden();
});

test('viewing a missing text brut returns 404', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    Sanctum::actingAs($doctor);

    $this->getJson('/api/text-bruts/99999')
        ->assertNotFound();
});
