<?php

use App\Enums\AnalysisStatusEnum;
use App\Models\TextBrut;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('the owner can update a draft text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create([
        'content' => 'Original content',
    ]);

    Sanctum::actingAs($doctor);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated content',
    ])
        ->assertOk()
        ->assertJsonPath('data.content', 'Updated content');

    $this->assertDatabaseHas('text_bruts', [
        'id' => $textBrut->id,
        'content' => 'Updated content',
    ]);
});

test('a guest cannot update a text brut', function () {
    $textBrut = TextBrut::factory()->create();

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated content',
    ])
        ->assertUnauthorized();
});

test('an assistant cannot update a text brut', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $textBrut = TextBrut::factory()->create();

    Sanctum::actingAs($assistant);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated content',
    ])
        ->assertForbidden();
});

test('a non owner receives 403 when updating a text brut', function () {
    $owner = User::factory()->create(['role' => 'doctor']);
    $other = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($owner, 'doctor')->create();

    Sanctum::actingAs($other);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated content',
    ])
        ->assertForbidden();
});

test('an analyzed text brut cannot be updated', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $textBrut->update(['analysis_status' => AnalysisStatusEnum::Analyzed]);

    Sanctum::actingAs($doctor);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated content',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('analysis_status');
});

test('a validated text brut cannot be updated', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $textBrut->update(['analysis_status' => AnalysisStatusEnum::Validated]);

    Sanctum::actingAs($doctor);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Updated content',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('analysis_status');
});

test('the content must be a string when updating', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();

    Sanctum::actingAs($doctor);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => ['not', 'a', 'string'],
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors('content');
});

test('updated content is persisted', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create([
        'content' => 'Original content',
    ]);

    Sanctum::actingAs($doctor);

    $this->putJson("/api/text-bruts/{$textBrut->id}", [
        'content' => 'Refreshed clinical note',
    ])
        ->assertOk();

    $this->assertDatabaseHas('text_bruts', [
        'id' => $textBrut->id,
        'content' => 'Refreshed clinical note',
    ]);

    $this->assertDatabaseMissing('text_bruts', [
        'id' => $textBrut->id,
        'content' => 'Original content',
    ]);
});
