<?php

use App\Models\Consultation;
use App\Models\TextBrut;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can view their consultation', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $consultation = Consultation::factory()->for($textBrut)->create();

    Sanctum::actingAs($doctor);

    $this->getJson("/api/consultations/{$consultation->id}")
        ->assertOk()
        ->assertJsonStructure([
            'data' => [
                'id',
                'text_brut_id',
                'text_brut' => [
                    'id',
                    'user_id',
                    'content',
                    'analysis_status',
                ],
                'chief_complaint',
                'symptoms',
                'observations',
                'diagnosis',
                'follow_up_date',
                'validated_at',
                'prescriptions',
                'created_at',
                'updated_at',
            ],
        ])
        ->assertJsonPath('data.id', $consultation->id)
        ->assertJsonPath('data.text_brut_id', $textBrut->id)
        ->assertJsonPath('data.chief_complaint', $consultation->chief_complaint)
        ->assertJsonPath('data.text_brut.id', $textBrut->id);
});

test('a guest cannot view a consultation', function () {
    $consultation = Consultation::factory()->create();

    $this->getJson("/api/consultations/{$consultation->id}")
        ->assertUnauthorized();
});

test('a non owner receives 403 when viewing a consultation', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($owner, 'doctor')->create();
    $consultation = Consultation::factory()->for($textBrut)->create();

    Sanctum::actingAs($other);

    $this->getJson("/api/consultations/{$consultation->id}")
        ->assertForbidden();
});

test('viewing a missing consultation returns 404', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    Sanctum::actingAs($doctor);

    $this->getJson('/api/consultations/99999')
        ->assertNotFound();
});
