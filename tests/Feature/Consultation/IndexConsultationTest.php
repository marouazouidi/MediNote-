<?php

use App\Models\Consultation;
use App\Models\TextBrut;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('an authenticated user can list their consultations', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBruts = TextBrut::factory()->count(3)->for($doctor, 'doctor')->create();

    $textBruts->each(fn ($textBrut) => Consultation::factory()->for($textBrut)->create());

    Sanctum::actingAs($doctor);

    $this->getJson('/api/consultations')
        ->assertOk()
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => [
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
            ],
        ]);
});

test('a guest cannot list consultations', function () {
    $this->getJson('/api/consultations')
        ->assertUnauthorized();
});

test('a user cannot see another users consultations', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $ownerTextBruts = TextBrut::factory()->count(2)->for($owner, 'doctor')->create();
    $ownerTextBruts->each(fn ($textBrut) => Consultation::factory()->for($textBrut)->create());

    $otherTextBrut = TextBrut::factory()->for($other, 'doctor')->create();
    $otherConsultation = Consultation::factory()->for($otherTextBrut)->create();

    Sanctum::actingAs($owner);

    $response = $this->getJson('/api/consultations')
        ->assertOk()
        ->assertJsonCount(2, 'data');

    $ids = collect($response->json('data'))->pluck('id')->all();

    expect($ids)->not->toContain($otherConsultation->id);
});

test('listing consultations with an empty collection succeeds', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    Sanctum::actingAs($doctor);

    $this->getJson('/api/consultations')
        ->assertOk()
        ->assertJsonCount(0, 'data');
});

test('consultations are paginated', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBruts = TextBrut::factory()->count(6)->for($doctor, 'doctor')->create();

    $textBruts->each(fn ($textBrut) => Consultation::factory()->for($textBrut)->create());

    Sanctum::actingAs($doctor);

    $this->getJson('/api/consultations')
        ->assertOk()
        ->assertJsonCount(5, 'data')
        ->assertJsonPath('meta.total', 6);

    $this->getJson('/api/consultations?page=2')
        ->assertOk()
        ->assertJsonCount(1, 'data');
});
