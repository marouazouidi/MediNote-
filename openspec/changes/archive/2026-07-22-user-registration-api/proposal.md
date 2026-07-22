## Why

MediNote has no authentication system. The application cannot distinguish between users, enforce role-based access, or secure API endpoints. A registration and authentication API is required before any user-facing features can be built.

## What Changes

- Add `role` column to the `users` table with enum:`doctor`, `assistant`
- Add Sanctum's `HasApiTokens` trait to the User model
- Create `routes/api.php` with auth endpoints
- Create `AuthController` with `register`, and `user` endpoints
- Create `RegisterRequest` and `LoginRequest` form requests for validation
- Create `AuthService` for registration and login business logic
- Create `UserResource` API resource for standardized user responses
- Create `RoleEnum` for role management
- Add role-based middleware or gate for authorization (prepares the ground but full authorization is scoped separately)
- Seed a default admin user

## Capabilities

### New Capabilities
- `user-registration`: API endpoints for user registration, login, logout, and retrieving the authenticated user, with role assignment and Sanctum token-based authentication.

### Modified Capabilities
None. No existing specs are being changed.

## Impact

- **Controllers**: New `AuthController` added
- **Services**: New `AuthService` added
- **Models**: `User` model updated with `HasApiTokens` and `role` attribute
- **Database**: New migration to add `role` column to `users` table
- **Routes**: New `routes/api.php` file with auth routes
- **Middleware**: Sanctum auth middleware applied to protected routes
- **Dependencies**: Sanctum already installed, no new packages needed