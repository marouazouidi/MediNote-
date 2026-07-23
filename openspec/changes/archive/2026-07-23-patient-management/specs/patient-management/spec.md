## ADDED Requirements

### Requirement: User can create a patient
The system SHALL allow any authenticated user to create a patient record with `first_name`, `last_name`, `birth_date`, `gender`, `phone`, `address`, and `allergies`.

#### Scenario: Create patient successfully
- **WHEN** an authenticated user sends a POST request to `/api/patients` with valid patient data
- **THEN** the system returns a 201 response with the patient data

#### Scenario: Create patient with missing required fields fails
- **WHEN** an authenticated user sends a POST request to `/api/patients` without `first_name` or `last_name`
- **THEN** the system returns a 422 response with validation errors

#### Scenario: Create patient with invalid gender fails
- **WHEN** an authenticated user sends a POST request to `/api/patients` with a gender other than `male` or `female`
- **THEN** the system returns a 422 response with a validation error for the gender field

### Requirement: User can list patients
The system SHALL return all patients when an authenticated user sends a GET request.

#### Scenario: List all patients
- **WHEN** an authenticated user sends a GET request to `/api/patients`
- **THEN** the system returns a 200 response with an array of patient records

### Requirement: User can view a single patient
The system SHALL return a specific patient by ID.

#### Scenario: View existing patient
- **WHEN** an authenticated user sends a GET request to `/api/patients/{id}` for an existing patient
- **THEN** the system returns a 200 response with the patient data

#### Scenario: View non-existent patient
- **WHEN** an authenticated user sends a GET request to `/api/patients/{id}` for a non-existent patient
- **THEN** the system returns a 404 response

### Requirement: User can update a patient
The system SHALL allow updating a patient's information.

#### Scenario: Update patient successfully
- **WHEN** an authenticated user sends a PUT request to `/api/patients/{id}` with valid fields
- **THEN** the system returns a 200 response with the updated patient data

### Requirement: User can delete a patient
The system SHALL soft-delete a patient.

#### Scenario: Delete existing patient
- **WHEN** an authenticated user sends a DELETE request to `/api/patients/{id}`
- **THEN** the system returns a 200 response and the patient is soft-deleted

### Requirement: User can search patients
The system SHALL allow searching patients by first or last name.

#### Scenario: Search by name
- **WHEN** an authenticated user sends a GET request to `/api/patients/search?q=keyword`
- **THEN** the system returns a 200 response with matching patients where first_name or last_name contains the keyword
