<?php

use App\AI\Schemas\AiAnalysisResult;
use App\AI\Schemas\AiPrescriptionData;
use App\Enums\AnalysisStatusEnum;
use App\Jobs\AnalyzeConsultationJob;
use App\Models\TextBrut;
use App\Services\AiResultStore;
use App\Services\AiService;
use App\Services\TextBrutService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Queue;

uses(RefreshDatabase::class);

test('the job implements ShouldQueue and uses the Queueable trait', function () {
    $textBrut = TextBrut::factory()->create();

    $job = new AnalyzeConsultationJob($textBrut);

    expect($job)->toBeInstanceOf(ShouldQueue::class);
    expect($job->textBrut->id)->toBe($textBrut->id);
});

test('the job is dispatched correctly to the queue', function () {
    $textBrut = TextBrut::factory()->create();

    Bus::fake();

    AnalyzeConsultationJob::dispatch($textBrut);

    Bus::assertDispatched(AnalyzeConsultationJob::class, function (AnalyzeConsultationJob $job) use ($textBrut) {
        return $job->textBrut->id === $textBrut->id;
    });
});

test('the job executes successfully and updates the text brut as analyzed', function () {
    $textBrut = TextBrut::factory()->create();

    $result = new AiAnalysisResult(
        chief_complaint: 'Headache',
        symptoms: ['Headache', 'Nausea'],
        observations: 'Patient reports persistent headache for three days.',
        diagnosis: 'Migraine',
        follow_up_date: '2026-09-01',
        prescriptions: [
            new AiPrescriptionData('Ibuprofen', '400mg', '3x/day', '5 days', null),
        ],
    );

    $aiService = Mockery::mock(AiService::class);
    $aiService->shouldReceive('analyze')
        ->once()
        ->with($textBrut)
        ->andReturn($result);

    $job = new AnalyzeConsultationJob($textBrut);
    $job->handle($aiService, app(TextBrutService::class));

    expect($textBrut->fresh()->analysis_status)->toBe(AnalysisStatusEnum::Analyzed);

    Mockery::close();
});

test('the job stores the expected structured output via the result store', function () {
    $textBrut = TextBrut::factory()->create();

    $result = new AiAnalysisResult(
        chief_complaint: 'Cough',
        symptoms: ['Cough', 'Fever'],
        observations: 'Dry cough with elevated temperature.',
        diagnosis: null,
        follow_up_date: null,
        prescriptions: [],
    );

    $aiService = Mockery::mock(AiService::class);
    $aiService->shouldReceive('analyze')->once()->with($textBrut)->andReturn($result);

    $job = new AnalyzeConsultationJob($textBrut);
    $job->handle($aiService, app(TextBrutService::class));

    $stored = app(AiResultStore::class)->get($textBrut);

    expect($stored)->not->toBeNull()
        ->and($stored->chief_complaint)->toBe('Cough')
        ->and($stored->symptoms)->toBe(['Cough', 'Fever']);

    Mockery::close();
});

test('the job sets the status to failed when the AI analysis throws', function () {
    $textBrut = TextBrut::factory()->create();

    $aiService = Mockery::mock(AiService::class);
    $aiService->shouldReceive('analyze')
        ->once()
        ->with($textBrut)
        ->andThrow(new RuntimeException('AI provider timeout'));

    $textBrutService = Mockery::mock(TextBrutService::class);
    $textBrutService->shouldNotReceive('markAsAnalyzed');

    $job = new AnalyzeConsultationJob($textBrut);

    expect(fn () => $job->handle($aiService, $textBrutService))
        ->toThrow(RuntimeException::class, 'AI provider timeout');

    expect($textBrut->fresh()->analysis_status)->toBe(AnalysisStatusEnum::Failed);

    Mockery::close();
});

test('the job rethrows the original exception after marking the failure', function () {
    $textBrut = TextBrut::factory()->create();

    $aiService = Mockery::mock(AiService::class);
    $aiService->shouldReceive('analyze')
        ->once()
        ->andThrow(new InvalidArgumentException('Malformed AI response'));

    $textBrutService = Mockery::mock(TextBrutService::class);
    $textBrutService->shouldNotReceive('markAsAnalyzed');

    $job = new AnalyzeConsultationJob($textBrut);

    try {
        $job->handle($aiService, $textBrutService);
    } catch (InvalidArgumentException $e) {
        expect($e->getMessage())->toBe('Malformed AI response');
        expect($textBrut->fresh()->analysis_status)->toBe(AnalysisStatusEnum::Failed);
        Mockery::close();

        return;
    }

    expect()->fail('The expected exception was not thrown.');
});

test('the job only calls analyze once per execution', function () {
    $textBrut = TextBrut::factory()->create();

    $result = new AiAnalysisResult(
        chief_complaint: 'Sore throat',
        symptoms: ['Sore throat'],
        observations: 'Mild inflammation.',
        diagnosis: null,
        follow_up_date: null,
        prescriptions: [],
    );

    $aiService = Mockery::mock(AiService::class);
    $aiService->shouldReceive('analyze')->once()->with($textBrut)->andReturn($result);

    $job = new AnalyzeConsultationJob($textBrut);
    $job->handle($aiService, app(TextBrutService::class));

    expect($textBrut->fresh()->analysis_status)->toBe(AnalysisStatusEnum::Analyzed);

    Mockery::close();
});

test('the job is pushed to the queue when dispatched via Queue facade', function () {
    $textBrut = TextBrut::factory()->create();

    Queue::fake();

    AnalyzeConsultationJob::dispatch($textBrut);

    Queue::assertPushed(AnalyzeConsultationJob::class, function (AnalyzeConsultationJob $job) use ($textBrut) {
        return $job->textBrut->is($textBrut);
    });
});
