## 1. Form Request

- [x] 1.1 Create `LoginRequest` in `app/Http/Requests/Auth/LoginRequest.php` with email and password validation rules

## 2. Service Layer

- [x] 2.1 Add `login()` method to `AuthService` — find user by email, verify password with `Hash::check`, throw `ValidationException` on mismatch
- [x] 2.2 Add `logout()` method to `AuthService` — revoke current token via `$user->currentAccessToken()->delete()`

## 3. Controller

- [x] 3.1 Add `login()` method to `AuthController` — validate with `LoginRequest`, delegate to `AuthService`, create token, return `UserResource` + token (200)
- [x] 3.2 Add `logout()` method to `AuthController` — delegate to `AuthService`, return success JSON message (200)

## 4. Routes

- [x] 4.1 Add public route: POST `/api/login`
- [x] 4.2 Add protected route: POST `/api/logout` inside `auth:sanctum` group
