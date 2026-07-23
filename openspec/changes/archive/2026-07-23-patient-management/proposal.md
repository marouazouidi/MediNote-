## Why

The application has no patient records. Both doctors and assistants need to create, view, update, delete, and search patient information before any appointments or consultations can take place.

## What Changes

- Create `patients` database table with first name, last name, birth date, gender, phone, address, allergies, and soft deletes
- Create `GenderEnum` with `male` and `female` values
- Create `Patient` model with `belongsTo User` relationship and soft deletes
- Create `PatientService` with CRUD and search logic
- Create `StorePatientRequest` and `UpdatePatientRequest` form requests
- Create `PatientResource` API resource
- Create `PatientController` with six endpoints
- Add patient routes to `routes/api.php`

## Capabilities

### New Capabilities
- `patient-management`: Full CRUD and search for patient records, accessible by both doctors and assistants.

### Modified Capabilities
None.

## Impact

- **Database**: New `patients` migration with foreign key to `users` table
- **Models**: New `Patient` model
- **Controllers**: New `PatientController` with `index`, `store`, `show`, `update`, `destroy`, `search`
- **Services**: New `PatientService`
- **Enums**: New `GenderEnum`
- **Form Requests**: New `StorePatientRequest` and `UpdatePatientRequest`
- **Resources**: New `PatientResource`
- **Routes**: 6 new endpoints under `auth:sanctum` group
