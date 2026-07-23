## ADDED Requirements

### Requirement: User can create an appointment
The system SHALL allow any authenticated user to create an appointment with `patient_id`, `appointment_date`, `appointment_time`, `reason`, and `status`.

#### Scenario: Create appointment successfully
- **WHEN** an authenticated user sends a POST request to `/api/appointments` with valid appointment data
- **THEN** the system returns a 201 response with the appointment data

#### Scenario: Create appointment with missing patient_id fails
- **WHEN** an authenticated user sends a POST request to `/api/appointments` without `patient_id`
- **THEN** the system returns a 422 response with validation error

#### Scenario: Create appointment with non-existent patient_id fails
- **WHEN** an authenticated user sends a POST request to `/api/appointments` with a `patient_id` that does not exist
- **THEN** the system returns a 422 response with validation error

#### Scenario: Create appointment with invalid status fails
- **WHEN** an authenticated user sends a POST request to `/api/appointments` with a status other than `scheduled`, `completed`, or `cancelled`
- **THEN** the system returns a 422 response with a validation error for the status field

### Requirement: User can list appointments
The system SHALL return all appointments when an authenticated user sends a GET request.

#### Scenario: List all appointments
- **WHEN** an authenticated user sends a GET request to `/api/appointments`
- **THEN** the system returns a 200 response with an array of appointment records

### Requirement: User can filter appointments by date and status
The system SHALL allow filtering appointments by date range and status via query parameters.

#### Scenario: Filter by status
- **WHEN** an authenticated user sends a GET request to `/api/appointments?status=scheduled`
- **THEN** the system returns a 200 response with only scheduled appointments

#### Scenario: Filter by date range
- **WHEN** an authenticated user sends a GET request to `/api/appointments?date_from=2026-07-01&date_to=2026-07-31`
- **THEN** the system returns a 200 response with appointments within the date range

### Requirement: User can view a single appointment
The system SHALL return a specific appointment by ID.

#### Scenario: View existing appointment
- **WHEN** an authenticated user sends a GET request to `/api/appointments/{id}` for an existing appointment
- **THEN** the system returns a 200 response with the appointment data

#### Scenario: View non-existent appointment
- **WHEN** an authenticated user sends a GET request to `/api/appointments/{id}` for a non-existent appointment
- **THEN** the system returns a 404 response

### Requirement: User can update an appointment
The system SHALL allow updating an appointment's information.

#### Scenario: Update appointment successfully
- **WHEN** an authenticated user sends a PUT request to `/api/appointments/{id}` with valid fields
- **THEN** the system returns a 200 response with the updated appointment data

### Requirement: User can cancel an appointment
The system SHALL soft-delete an appointment to cancel it.

#### Scenario: Cancel existing appointment
- **WHEN** an authenticated user sends a DELETE request to `/api/appointments/{id}`
- **THEN** the system returns a 200 response and the appointment is soft-deleted
