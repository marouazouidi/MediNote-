<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('authenticated user can logout', function () {

    $user = User::factory()->create();

    $token = $user->createToken('auth-token')->plainTextToken;

    $response = $this
        ->withHeader('Authorization', 'Bearer '.$token)
        ->postJson('/api/logout');

    $response
        ->assertOk()
        ->assertJson([
            'message' => 'Déconnexion réussie.',
        ]);
});

test('guest cannot logout', function () {

    $this->postJson('/api/logout')
        ->assertUnauthorized();
});

test('deletes the current access token after logout', function () {

    $user = User::factory()->create();

    $token = $user->createToken('auth-token');

    $this->withHeader(
        'Authorization',
        'Bearer '.$token->plainTextToken
    )->postJson('/api/logout');

    expect($user->tokens()->count())->toBe(0);
});