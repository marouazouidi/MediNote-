## Purpose

Allow users to create an account in MediNote and authenticate via Sanctum tokens. All new users are assigned the `assistant` role by default.

## Requirements

### Requirement: User can register
The system SHALL allow any user to register with a `name`, `email`, and `password`. The role is always assigned as `assistant`.

#### Scenario: User registers successfully
- **WHEN** a user sends a POST request to `/api/register` with valid `name`, `email`, and `password`
- **THEN** the system returns a 201 response with the user data, a Bearer token, and the role is `assistant`

#### Scenario: Registration with duplicate email fails
- **WHEN** a user sends a POST request to `/api/register` with an email already in use
- **THEN** the system returns a 422 response with a validation error for the email field

### Requirement: User can retrieve their profile
The system SHALL allow an authenticated user to retrieve their own user information.

#### Scenario: Get current user
- **WHEN** an authenticated user sends a GET request to `/api/user`
- **THEN** the system returns a 200 response with the user data (id, name, email, role)

#### Scenario: Unauthenticated request fails
- **WHEN** a request without a valid Bearer token is sent to `/api/user`
- **THEN** the system returns a 401 Unauthorized response
