<?php

use App\Enums\AnalysisStatusEnum;
use App\Jobs\AnalyzeConsultationJob;
use App\Models\TextBrut;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('a doctor can trigger the analysis of a text brut', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();

    Queue::fake();

    Sanctum::actingAs($doctor);

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")
        ->assertAccepted()
        ->assertJson(['message' => 'AI analysis started.']);

    Queue::assertPushed(AnalyzeConsultationJob::class, function (AnalyzeConsultationJob $job) use ($textBrut) {
        return $job->textBrut->id === $textBrut->id;
    });

    $this->assertDatabaseHas('text_bruts', [
        'id' => $textBrut->id,
        'analysis_status' => 'pending',
    ]);
});

test('a guest cannot trigger the analysis', function () {
    $textBrut = TextBrut::factory()->create();

    Queue::fake();

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")
        ->assertUnauthorized();

    Queue::assertNothingPushed();
});

test('an assistant cannot trigger the analysis', function () {
    $assistant = User::factory()->create(['role' => 'assistant']);

    $textBrut = TextBrut::factory()->create();

    Queue::fake();

    Sanctum::actingAs($assistant);

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")
        ->assertForbidden();

    Queue::assertNothingPushed();
});

test('an analysis cannot be triggered twice', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $textBrut->update(['analysis_status' => AnalysisStatusEnum::Analyzed]);

    Queue::fake();

    Sanctum::actingAs($doctor);

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")
        ->assertUnprocessable()
        ->assertJsonValidationErrors('analysis_status');

    Queue::assertNothingPushed();
});

test('a validated text brut cannot be analyzed again', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create();
    $textBrut->update(['analysis_status' => AnalysisStatusEnum::Validated]);

    Queue::fake();

    Sanctum::actingAs($doctor);

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")
        ->assertUnprocessable()
        ->assertJsonValidationErrors('analysis_status');

    Queue::assertNothingPushed();
});

test('the analysis status is set to pending after triggering', function () {
    $doctor = User::factory()->create(['role' => 'doctor']);

    $textBrut = TextBrut::factory()->for($doctor, 'doctor')->create([
        'analysis_status' => 'pending',
    ]);

    Queue::fake();

    Sanctum::actingAs($doctor);

    $this->postJson("/api/text-bruts/{$textBrut->id}/analyze")
        ->assertAccepted();

    expect($textBrut->fresh()->analysis_status)->toBe(AnalysisStatusEnum::Pending);
});
