# TextBrut Management

## Purpose

Allow authenticated doctors to store, view, and update the original free-text consultation note before AI processing. The TextBrut preserves the raw medical note for auditing and traceability, keeping it independent from the AI-generated structured consultation.

## Requirements

### Requirement: User can create a TextBrut
The system SHALL allow any authenticated user to create a TextBrut with `appointment_id`, `content`, and `analysis_status`.

#### Scenario: Create TextBrut successfully
- **WHEN** an authenticated user sends a POST request to `/api/text-bruts` with valid data
- **THEN** the system returns a 201 response with the TextBrut data

#### Scenario: Create TextBrut with missing appointment_id fails
- **WHEN** an authenticated user sends a POST request to `/api/text-bruts` without `appointment_id`
- **THEN** the system returns a 422 response with validation error

#### Scenario: Create TextBrut for non-existent appointment fails
- **WHEN** an authenticated user sends a POST request to `/api/text-bruts` with an `appointment_id` that does not exist
- **THEN** the system returns a 422 response with validation error

#### Scenario: Create duplicate TextBrut for same appointment fails
- **WHEN** an authenticated user sends a POST request to `/api/text-bruts` with an `appointment_id` that already has a TextBrut
- **THEN** the system returns a 422 response with a validation error

### Requirement: User can view a single TextBrut
The system SHALL return a specific TextBrut by ID.

#### Scenario: View existing TextBrut
- **WHEN** an authenticated user sends a GET request to `/api/text-bruts/{id}` for an existing TextBrut
- **THEN** the system returns a 200 response with the TextBrut data

#### Scenario: View non-existent TextBrut
- **WHEN** an authenticated user sends a GET request to `/api/text-bruts/{id}` for a non-existent TextBrut
- **THEN** the system returns a 404 response

### Requirement: User can update a TextBrut
The system SHALL allow updating a TextBrut's content and analysis_status.

#### Scenario: Update TextBrut successfully
- **WHEN** an authenticated user sends a PUT request to `/api/text-bruts/{id}` with valid fields
- **THEN** the system returns a 200 response with the updated TextBrut data
