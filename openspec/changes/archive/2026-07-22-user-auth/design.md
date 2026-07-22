## Context

The `user-registration` capability is already implemented with public registration (always assigns `assistant` role) and a protected `GET /api/user` endpoint. Users have no way to login to obtain a Sanctum token, or logout to revoke one.

## Goals / Non-Goals

**Goals:**
- Enable users to login with email and password, receiving a Sanctum token
- Enable users to logout, revoking their current token
- Follow existing patterns: thin controller, AuthService, Form Requests, UserResource

**Non-Goals:**
- Token refresh or expiration logic
- Password reset or email verification
- Social login or OAuth
- Rate limiting on login attempts

## Decisions

- **Reuse `auth:sanctum` middleware**: Already configured, protects `/api/logout` and `/api/user`
- **Reuse `UserResource`**: Already returns id, name, email, role — returned on login alongside the token
- **Login returns new token each call**: Sanctum's `createToken()` generates a fresh token on every login
- **Logout revokes current token only**: Uses `$user->currentAccessToken()->delete()`, preserving other active sessions
- **Login route is public**: Any user with valid credentials can authenticate
- **LoginRequest validates email + password**: Presence check only; authentication failure is handled by AuthService with `ValidationException`

## Risks / Trade-offs

- [No login throttling] → Add rate limiting middleware later if brute force becomes a concern
- [No token expiration] → Sanctum's `expiration` is null; production should set a token lifetime and add refresh logic
