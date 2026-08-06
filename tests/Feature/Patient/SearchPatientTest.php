<?php

use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('a user can search patients by first name', function () {
    $user = User::factory()->create();

    Patient::factory()->for($user)->create(['first_name' => 'Sophie']);
    Patient::factory()->for($user)->create(['first_name' => 'Marc']);

    Sanctum::actingAs($user);

    $this->getJson('/api/patients/search?q=Sophie')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.first_name', 'Sophie');
});

test('a user can search patients by last name', function () {
    $user = User::factory()->create();

    Patient::factory()->for($user)->create(['last_name' => 'Martins']);
    Patient::factory()->for($user)->create(['last_name' => 'Dupont']);

    Sanctum::actingAs($user);

    $this->getJson('/api/patients/search?q=Martins')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.last_name', 'Martins');
});

test('a user can search patients by phone', function () {
    $user = User::factory()->create();

    Patient::factory()->for($user)->create(['phone' => '+33612345678']);
    Patient::factory()->for($user)->create(['phone' => '+33123456789']);

    Sanctum::actingAs($user);

    $this->getJson('/api/patients/search?q=612345678')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.phone', '+33612345678');
});

test('a user can search patients by address', function () {
    $user = User::factory()->create();

    Patient::factory()->for($user)->create(['address' => 'Rue de la Paix']);
    Patient::factory()->for($user)->create(['address' => 'Avenue des Champs']);

    Sanctum::actingAs($user);

    $this->getJson('/api/patients/search?q=Rue')
        ->assertOk()
        ->assertJsonCount(1, 'data')
        ->assertJsonPath('data.0.address', 'Rue de la Paix');
});

test('searching returns an empty collection when nothing matches', function () {
    $user = User::factory()->create();

    Patient::factory()->count(2)->for($user)->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/patients/search?q=zzzzzzznomatch')
        ->assertOk()
        ->assertJsonCount(0, 'data');
});

test('the q parameter is required', function () {
    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $this->getJson('/api/patients/search')
        ->assertUnprocessable()
        ->assertJsonValidationErrors('q');
});

test('a guest cannot search patients', function () {
    $this->getJson('/api/patients/search?q=Sophie')
        ->assertUnauthorized();
});
