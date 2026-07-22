## Why

Users can register but have no way to log in or out. Without login, they cannot obtain a Sanctum token to access protected endpoints. Without logout, tokens cannot be revoked.

## What Changes

- Create `LoginRequest` with email and password validation
- Add `login()` and `logout()` methods to `AuthService`
- Add `login()` and `logout()` methods to `AuthController`
- Add `POST /api/login` (public) and `POST /api/logout` (auth:sanctum) routes
- Login authenticates with email/password, returns `UserResource` + Sanctum token
- Logout revokes the current access token, returns success JSON

## Capabilities

### New Capabilities
- `user-auth`: Login and logout endpoints using Sanctum token-based authentication, enabling users to obtain and revoke API tokens.

### Modified Capabilities
None.

## Impact

- **Controllers**: `login()` and `logout()` added to `AuthController`
- **Services**: `login()` and `logout()` added to `AuthService`
- **Form Requests**: New `LoginRequest` with email, password rules
- **Routes**: `POST /api/login` and `POST /api/logout` added to `routes/api.php`
