<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        $user = $authService->register($request->validated());

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

    public function login(LoginRequest $request, AuthService $authService): JsonResponse
    {
        $user = $authService->login(
            $request->validated('email'),
            $request->validated('password')
        );

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function logout(Request $request, AuthService $authService): JsonResponse
    {
        $authService->logout($request->user());

        return response()->json([
            'message' => 'Déconnexion réussie.',
        ]);
    }

    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
