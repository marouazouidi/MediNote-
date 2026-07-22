## Purpose

Allow registered users to authenticate via Sanctum tokens (login) and revoke their own tokens (logout).

## Requirements

### Requirement: User can login
The system SHALL allow any registered user to login with their email and password, returning a new Sanctum token and their user information.

#### Scenario: Successful login
- **WHEN** a registered user sends a POST request to `/api/login` with valid `email` and `password`
- **THEN** the system returns a 200 response with the user data (id, name, email, role) and a Bearer token

#### Scenario: Login with incorrect password fails
- **WHEN** a user sends a POST request to `/api/login` with a wrong password
- **THEN** the system returns a 422 response with a validation error message

#### Scenario: Login with non-existent email fails
- **WHEN** a request is sent to `/api/login` with an email that does not exist
- **THEN** the system returns a 422 response with a validation error message

### Requirement: User can logout
The system SHALL allow an authenticated user to logout by revoking their current Sanctum token.

#### Scenario: Successful logout
- **WHEN** an authenticated user sends a POST request to `/api/logout` with a valid Bearer token
- **THEN** the system returns a 200 response with a success message and the token is revoked
