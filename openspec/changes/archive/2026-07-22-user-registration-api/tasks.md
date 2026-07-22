## 1. Database & Model

- [x] 1.1 Create migration to add `role` column to `users` table (doctor, assistant)
- [x] 1.2 Create `RoleEnum` in `app/Enums/RoleEnum.php` with Doctor, Assistant cases
- [x] 1.3 Add `HasApiTokens` trait and `role` cast to User model
- [x] 1.4 Add `role` to User model fillable attributes
- [x] 1.5 Run migrations

## 2. Service Layer

- [x] 2.1 Create `AuthService` in `app/Services/AuthService.php`
- [x] 2.2 Implement `register()` method — create user, default role to assistant, generate token

## 3. Form Requests

- [x] 3.1 Create `RegisterRequest` in `app/Http/Requests/Auth/RegisterRequest.php` with name, email, password validation; role optional

## 4. API Resource

- [x] 4.1 Create `UserResource` in `app/Http/Resources/UserResource.php` exposing id, name, email, role, created_at

## 5. Controller

- [x] 5.1 Create `AuthController` in `app/Http/Controllers/Api/AuthController.php`
- [x] 5.2 Implement `register()` — public, delegate to AuthService, return UserResource + token
- [x] 5.3 Implement `user()` — return authenticated user via UserResource

## 6. Routes

- [x] 6.1 Create `routes/api.php` with route group
- [x] 6.2 Add public route: POST `/api/register`
- [x] 6.3 Add sanctum-protected route: GET `/api/user`

## 7. Seeder

- [x] 7.1 Create a default doctor seed (doctor@medinote.com)
