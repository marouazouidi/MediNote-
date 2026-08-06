<?php

use App\AI\Agents\ConsultationAnalysisAgent;
use App\AI\Schemas\AiAnalysisResult;
use App\AI\Schemas\AiPrescriptionData;
use App\Models\TextBrut;
use App\Services\AiService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\ConnectionException;
use Laravel\Ai\Responses\AgentResponse;
use Laravel\Ai\Responses\Data\Meta;
use Laravel\Ai\Responses\Data\Usage;
use Tests\TestCase;

uses(TestCase::class);
uses(RefreshDatabase::class);

class FakeAiResponse extends AgentResponse
{
    public function __construct(private array $data)
    {
        parent::__construct('fake-invocation-id', 'fake text', new Usage, new Meta('fake', 'fake-model'));
    }

    public function toArray(): array
    {
        return $this->data;
    }
}

test('a successful AI response is mapped to an AiAnalysisResult', function () {
    $textBrut = TextBrut::factory()->create([
        'content' => 'Patient reports headache and fever.',
    ]);

    $payload = [
        'chief_complaint' => 'Headache',
        'symptoms' => ['Headache', 'Fever'],
        'observations' => 'Patient reports headache and fever for two days.',
        'diagnosis' => 'Viral infection',
        'follow_up_date' => '2026-09-01',
        'prescriptions' => [
            [
                'medication_name' => 'Paracetamol',
                'dosage' => '500mg',
                'frequency' => '3x/day',
                'duration' => '5 days',
                'instructions' => null,
            ],
        ],
    ];

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')
        ->once()
        ->with($textBrut->content)
        ->andReturn(new FakeAiResponse($payload));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    $result = (new AiService)->analyze($textBrut);

    expect($result)->toBeInstanceOf(AiAnalysisResult::class)
        ->and($result->chief_complaint)->toBe('Headache')
        ->and($result->symptoms)->toBe(['Headache', 'Fever'])
        ->and($result->observations)->toBe('Patient reports headache and fever for two days.')
        ->and($result->diagnosis)->toBe('Viral infection')
        ->and($result->follow_up_date)->toBe('2026-09-01')
        ->and($result->prescriptions)->toHaveCount(1);

    expect($result->prescriptions[0])->toBeInstanceOf(AiPrescriptionData::class)
        ->and($result->prescriptions[0]->medication_name)->toBe('Paracetamol');

    Mockery::close();
});

test('the action returns the expected DTO schema structure', function () {
    $textBrut = TextBrut::factory()->create();

    $payload = [
        'chief_complaint' => 'Cough',
        'symptoms' => ['Cough'],
        'observations' => 'Dry cough.',
        'diagnosis' => null,
        'follow_up_date' => null,
        'prescriptions' => [],
    ];

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')->once()->andReturn(new FakeAiResponse($payload));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    $result = (new AiService)->analyze($textBrut);

    expect($result->toArray())->toBe([
        'chief_complaint' => 'Cough',
        'symptoms' => ['Cough'],
        'observations' => 'Dry cough.',
        'diagnosis' => null,
        'follow_up_date' => null,
        'prescriptions' => [],
    ]);

    Mockery::close();
});

test('the action produces correct structured output including prescriptions', function () {
    $textBrut = TextBrut::factory()->create();

    $payload = [
        'chief_complaint' => 'Back pain',
        'symptoms' => ['Back pain', 'Stiffness'],
        'observations' => 'Lower back pain since morning.',
        'diagnosis' => 'Lumbago',
        'follow_up_date' => '2026-08-20',
        'prescriptions' => [
            [
                'medication_name' => 'Ibuprofen',
                'dosage' => '400mg',
                'frequency' => '2x/day',
                'duration' => '7 days',
                'instructions' => 'Take with food',
            ],
            [
                'medication_name' => 'Stretch exercises',
                'dosage' => null,
                'frequency' => 'daily',
                'duration' => '14 days',
                'instructions' => null,
            ],
        ],
    ];

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')->once()->andReturn(new FakeAiResponse($payload));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    $result = (new AiService)->analyze($textBrut);

    expect($result->prescriptions)->toHaveCount(2);
    expect($result->prescriptions[0]->medication_name)->toBe('Ibuprofen');
    expect($result->prescriptions[0]->instructions)->toBe('Take with food');
    expect($result->prescriptions[1]->medication_name)->toBe('Stretch exercises');

    Mockery::close();
});

test('a malformed response missing required fields throws', function () {
    $textBrut = TextBrut::factory()->create();

    $payload = [
        'observations' => 'Missing chief complaint and symptoms.',
    ];

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')->once()->andReturn(new FakeAiResponse($payload));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    expect(fn () => (new AiService)->analyze($textBrut))
        ->toThrow(ErrorException::class);

    Mockery::close();
});

test('an empty response throws when building the schema', function () {
    $textBrut = TextBrut::factory()->create();

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')->once()->andReturn(new FakeAiResponse([]));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    expect(fn () => (new AiService)->analyze($textBrut))
        ->toThrow(ErrorException::class);

    Mockery::close();
});

test('an invalid JSON structure throws on mapping', function () {
    $textBrut = TextBrut::factory()->create();

    $payload = [
        'chief_complaint' => 'Headache',
        'symptoms' => 'not-an-array',
        'observations' => 'Observation text.',
        'diagnosis' => null,
        'follow_up_date' => null,
        'prescriptions' => 'not-an-array',
    ];

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')->once()->andReturn(new FakeAiResponse($payload));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    expect(fn () => (new AiService)->analyze($textBrut))
        ->toThrow(TypeError::class);

    Mockery::close();
});

test('a timeout exception from the agent is propagated', function () {
    $textBrut = TextBrut::factory()->create();

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')
        ->once()
        ->andThrow(new ConnectionException('AI provider timed out'));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    expect(fn () => (new AiService)->analyze($textBrut))
        ->toThrow(ConnectionException::class, 'AI provider timed out');

    Mockery::close();
});

test('a generic exception from the agent is propagated', function () {
    $textBrut = TextBrut::factory()->create();

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')
        ->once()
        ->andThrow(new RuntimeException('Something went wrong'));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    expect(fn () => (new AiService)->analyze($textBrut))
        ->toThrow(RuntimeException::class, 'Something went wrong');

    Mockery::close();
});

test('the action prompts the agent with the text brut content', function () {
    $textBrut = TextBrut::factory()->create([
        'content' => 'Unique consultation content for assertion.',
    ]);

    $agent = Mockery::mock(ConsultationAnalysisAgent::class);
    $agent->shouldReceive('prompt')
        ->once()
        ->with('Unique consultation content for assertion.')
        ->andReturn(new FakeAiResponse([
            'chief_complaint' => 'X',
            'symptoms' => ['X'],
            'observations' => 'X',
            'diagnosis' => null,
            'follow_up_date' => null,
            'prescriptions' => [],
        ]));

    $this->app->instance(ConsultationAnalysisAgent::class, $agent);

    $result = (new AiService)->analyze($textBrut);

    expect($result->chief_complaint)->toBe('X');

    Mockery::close();
});
