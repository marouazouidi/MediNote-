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
    /**
     * Register a new user.
     *
     * Creates a new user account with the provided credentials and returns an API authentication token.
     * The account is created with the "assistant" role by default. Both doctors and assistants can access the system,
     * but only doctors can create consultations and use AI analysis features.
     *
     * @group Authentication
     *
     * @unauthenticated
     *
     * @bodyParam name string required The full name of the user. Example: Dr. Jane Doe
     * @bodyParam email string required The email address of the user. Must be unique. Example: doctor@example.com
     * @bodyParam password string required The user password. Must be at least 8 characters. Example: password123
     *
     * @response status=201 {
     *   "user": {
     *     "id": 1,
     *     "name": "Dr. Jane Doe",
     *     "email": "doctor@example.com",
     *     "role": "assistant",
     *     "created_at": "2026-08-07T10:00:00.000000Z"
     *   },
     *   "token": "1|laravel_sanctum_token_here"
     * }
     * @response status=422 {
     *   "message": "The name field is required.",
     *   "errors": {
     *     "name": ["The name field is required."]
     *   }
     * }
     */
    public function register(RegisterRequest $request, AuthService $authService): JsonResponse
    {
        $user = $authService->register($request->validated());

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }

    /**
     * Log in to the application.
     *
     * Authenticates a user with their email address and password, returning an API authentication token on success.
     * The returned token must be included in the Authorization header as a Bearer token for all subsequent authenticated requests.
     *
     * @group Authentication
     *
     * @unauthenticated
     *
     * @bodyParam email string required The email address of the user. Example: doctor@example.com
     * @bodyParam password string required The user password. Example: password123
     *
     * @response {
     *   "user": {
     *     "id": 1,
     *     "name": "Dr. Jane Doe",
     *     "email": "doctor@example.com",
     *     "role": "assistant",
     *     "created_at": "2026-08-07T10:00:00.000000Z"
     *   },
     *   "token": "1|laravel_sanctum_token_here"
     * }
     * @response status=422 {
     *   "message": "The email field is required.",
     *   "errors": {
     *     "email": ["The email field is required."]
     *   }
     * }
     */
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

    /**
     * Log out of the application.
     *
     * Revokes the current user's API authentication token, effectively ending the session. The token can no longer be used for subsequent requests.
     *
     * @group Authentication
     *
     * @authenticated
     *
     * @response {
     *   "message": "Déconnexion réussie."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function logout(Request $request, AuthService $authService): JsonResponse
    {
        $authService->logout($request->user());

        return response()->json([
            'message' => 'Déconnexion réussie.',
        ]);
    }

    /**
     * Get the currently authenticated user.
     *
     * Returns the profile information of the user associated with the provided API token, including their name, email, and assigned role.
     *
     * @group Authentication
     *
     * @authenticated
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "name": "Dr. Jane Doe",
     *     "email": "doctor@example.com",
     *     "role": "assistant",
     *     "created_at": "2026-08-07T10:00:00.000000Z"
     *   }
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function user(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
