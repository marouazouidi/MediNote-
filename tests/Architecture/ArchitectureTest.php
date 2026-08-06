<?php

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Resources\Json\JsonResource;

/*
|--------------------------------------------------------------------------
| Architecture Tests
|--------------------------------------------------------------------------
|
| These tests enforce the structural rules of the MediNote codebase:
| layer inheritance, namespace locality, dependency direction, and
| banned constructs.
|
*/

// ---------------------------------------------------------------------------
// Inheritance & type rules
// ---------------------------------------------------------------------------

arch('models extend Eloquent Model')
    ->expect('App\Models')
    ->classes()
    ->toExtend(Model::class);

arch('controllers extend the base Controller')
    ->expect('App\Http\Controllers')
    ->classes()
    ->toExtend(Controller::class);

arch('requests extend FormRequest')
    ->expect('App\Http\Requests')
    ->classes()
    ->toExtend(FormRequest::class);

arch('resources extend JsonResource')
    ->expect('App\Http\Resources')
    ->classes()
    ->toExtend(JsonResource::class);

arch('jobs implement ShouldQueue')
    ->expect('App\Jobs')
    ->classes()
    ->toImplement(ShouldQueue::class);

// ---------------------------------------------------------------------------
// Namespace locality rules
// ---------------------------------------------------------------------------

arch('enums live in App\Enums')
    ->expect('App\Enums')
    ->toBeEnums();

arch('services do not depend on controllers or requests')
    ->expect('App\Services')
    ->classes()
    ->not->toUse(['App\Http\Controllers', 'App\Http\Requests', 'App\Http\Resources']);

arch('policies do not depend on the service or HTTP layer')
    ->expect('App\Policies')
    ->classes()
    ->not->toUse(['App\Services', 'App\Http', 'Illuminate\Http']);

// ---------------------------------------------------------------------------
// Layer dependency rules
// ---------------------------------------------------------------------------

arch('controllers delegate to services')
    ->expect('App\Http\Controllers\Api')
    ->classes()
    ->toUse('App\Services');

arch('controllers do not run database queries directly')
    ->expect('App\Http\Controllers\Api')
    ->classes()
    ->not->toUse('Illuminate\Database');

arch('requests do not contain business logic')
    ->expect('App\Http\Requests')
    ->classes()
    ->not->toUse(['App\Services', 'App\Models', 'App\AI']);

arch('services do not depend on the HTTP layer')
    ->expect('App\Services')
    ->classes()
    ->not->toUse(['Illuminate\Http', 'App\Http']);

// ---------------------------------------------------------------------------
// Banned constructs
// ---------------------------------------------------------------------------

arch('no debug functions are used in the codebase')
    ->expect([
        'dd',
        'dump',
        'ray',
        'var_dump',
        'print_r',
        'die',
        'exit',
    ])
    ->not->toBeUsed();

// ---------------------------------------------------------------------------
// Production code must not contain leftover TODOs.
// ---------------------------------------------------------------------------

test('production code does not contain leftover TODOs', function () {
    $loader = require str_replace('\\', '/', __DIR__).'/../../vendor/autoload.php';
    $frameworkPath = str_replace('\\', '/', dirname($loader->findFile(Application::class)));
    $appPath = preg_replace('#/vendor/laravel/framework/src/Illuminate/Foundation$#', '/app', $frameworkPath);

    $files = [];

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($appPath, RecursiveDirectoryIterator::SKIP_DOTS),
    );

    foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
            $files[] = $file->getPathname();
        }
    }

    $violations = [];

    foreach ($files as $path) {
        $handle = fopen($path, 'r');

        if ($handle === false) {
            continue;
        }

        $lineNumber = 0;

        while (($line = fgets($handle)) !== false) {
            $lineNumber++;

            if (preg_match('/\b(TODO|FIXME|XXX|HACK)\b/i', $line)) {
                $relative = str_replace('\\', '/', str_replace($appPath.'/', '', $path));
                $violations[] = sprintf('%s:%s', $relative, $lineNumber);
            }
        }

        fclose($handle);
    }

    expect($violations)->toBeEmpty(
        sprintf("Found leftover markers:\n%s", implode("\n", $violations)),
    );
});
