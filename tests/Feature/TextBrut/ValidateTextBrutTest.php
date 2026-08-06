<?php

use App\AI\Schemas\AiAnalysisResult;
use App\AI\Schemas\AiPrescriptionData;
use App\Enums\AnalysisStatusEnum;
use App\Models\Consultation;
use App\Models\TextBrut;
use App\Models\User;
use App\Services\AiResultStore;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('a doctor can validate an analyzed text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $textBrut->update(['analysis_status' => AnalysisStatusEnum::Analyzed]);

    $result = new AiAnalysisResult(
        chief_complaint: 'Fever',
        symptoms: ['Fever', 'Cough'],
        observations: 'Temperature at 38.5°C.',
        diagnosis: 'Influenza',
        follow_up_date: '2026-09-01',
        prescriptions: [
            new AiPrescriptionData('Paracetamol', '500mg', '3x/day', '5 days', null),
        ],
    );

    app(AiResultStore::class)->put($textBrut, $result);

    Sanctum::actingAs($doctor);

    $response = $this->postJson("/api/text-bruts/{$textBrut->id}/validate");

    $response
        ->assertCreated()
        ->assertJsonStructure([
            'data' => [
                'id',
                'text_brut_id',
                'chief_complaint',
                'symptoms',
                'observations',
                'diagnosis',
                'follow_up_date',
                'validated_at',
                'prescriptions',
            ],
        ])
        ->assertJsonPath('data.text_brut_id', $textBrut->id)
        ->assertJsonPath('data.chief_complaint', 'Fever')
        ->assertJsonPath('data.diagnosis', 'Influenza');

    $this->assertDatabaseHas('consultations', [
        'text_brut_id' => $textBrut->id,
        'chief_complaint' => 'Fever',
        'diagnosis' => 'Influenza',
    ]);

    $this->assertDatabaseHas('prescriptions', [
        'medication_name' => 'Paracetamol',
        'dosage' => '500mg',
        'frequency' => '3x/day',
        'duration' => '5 days',
    ]);

    $this->assertDatabaseHas('text_bruts', [
        'id' => $textBrut->id,
        'analysis_status' => 'validated',
    ]);

    expect(app(AiResultStore::class)->get($textBrut))->toBeNull();
});

test('a guest cannot validate a text brut', function () {
    $textBrut = TextBrut::factory()->create();

    $this->postJson("/api/text-bruts/{$textBrut->id}/validate")
        ->assertUnauthorized();
});

test('an assistant cannot validate a text brut', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $textBrut = TextBrut::factory()->create();

    Sanctum::actingAs($assistant);

    $this->postJson("/api/text-bruts/{$textBrut->id}/validate")
        ->assertForbidden();
});

test('a pending text brut cannot be validated', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();

    Sanctum::actingAs($doctor);

    $this->postJson("/api/text-bruts/{$textBrut->id}/validate")
        ->assertUnprocessable()
        ->assertJsonValidationErrors('analysis_status');
});

test('an analyzed text brut without a cached result cannot be validated', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $textBrut->update(['analysis_status' => AnalysisStatusEnum::Analyzed]);

    Sanctum::actingAs($doctor);

    $this->postJson("/api/text-bruts/{$textBrut->id}/validate")
        ->assertUnprocessable()
        ->assertJsonValidationErrors('ai_result');
});

test('a text brut with an existing consultation cannot be validated again', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $textBrut->update(['analysis_status' => AnalysisStatusEnum::Analyzed]);

    $result = new AiAnalysisResult(
        chief_complaint: 'Fever',
        symptoms: ['Fever'],
        observations: 'Temperature at 38.5°C.',
        diagnosis: 'Influenza',
        follow_up_date: null,
        prescriptions: [],
    );

    app(AiResultStore::class)->put($textBrut, $result);

    Consultation::create([
        'text_brut_id' => $textBrut->id,
        'chief_complaint' => 'Fever',
        'symptoms' => ['Fever'],
        'observations' => 'Temperature at 38.5°C.',
        'diagnosis' => 'Influenza',
        'follow_up_date' => null,
        'validated_at' => now(),
    ]);

    Sanctum::actingAs($doctor);

    $this->postJson("/api/text-bruts/{$textBrut->id}/validate")
        ->assertUnprocessable()
        ->assertJsonValidationErrors('consultation');
});
