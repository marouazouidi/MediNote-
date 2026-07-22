## Context

MediNote currently has no authentication system. The User model lacks Sanctum's `HasApiTokens` trait, no API routes exist, no auth controllers or services exist. Sanctum is installed but unused.

This design covers the User Registration API — the first step toward role-based access control for the medical practice management system.

## Goals / Non-Goals

**Goals:**
- Enable user registration with role assignment (admin, doctor, assistant)
- Provide token-based authentication via Sanctum for the React SPA
- Expose endpoints: register, login, logout, get current user
- Validate inputs with Form Requests
- Return standardized user responses via API Resources

**Non-Goals:**
- Role-based authorization middleware (scoped separately)
- Password reset / email verification flows
- OAuth or social login
- User profile management (update, delete)
- Frontend auth UI (React implementation scoped separately)

## Decisions

- **Sanctum for API auth**: Already installed; designed for SPAs and mobile apps. API tokens via token-based auth (Bearer tokens in `Authorization` header) for the React frontend.
- **Role as enum on User model**: Simple, auditable, avoids a separate roles table for three roles. A `RoleEnum` PHP enum with `Admin`, `Doctor`, `Assistant` cases.
- **Admin creates users**: In a medical context, self-registration is inappropriate. An admin registers new doctors and assistants. The register endpoint requires an authenticated admin with the `admin` role.
- **Login returns a plain token**: Sanctum's `createToken()` returns a plain-text token on the first response only (not stored in DB in plaintext). The SPA stores it client-side.
- **AuthService for business logic**: Keeps the controller thin. Handles registration, login, and logout.
- **RegisterRequest / LoginRequest**: Form Requests for validation with consistent error responses.
- **UserResource**: API Resource for standardized user JSON shape across all user-related endpoints.
- **routes/api.php as route file**: Standard Laravel pattern for API routes with `api` prefix.

## Risks / Trade-offs

- [Single role column vs roles table] → Chosen for simplicity with three roles. If role hierarchy or permissions grow, migrate to a roles table later.
- [Token expiration disabled by default] → Sanctum's `expiration` is null. Production should set a token lifetime (e.g., 24h) and implement refresh logic.
- [No email verification] → Deferred. Registration is admin-gated, so verified emails are less critical initially.
