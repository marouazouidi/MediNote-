## 1. Database & Enum

- [x] 1.1 Create `GenderEnum` in `app/Enums/GenderEnum.php` with Male, Female cases
- [x] 1.2 Create migration `create_patients_table` with all columns and soft deletes
- [x] 1.3 Run migrations

## 2. Model

- [x] 2.1 Create `Patient` model with fillable, casts, soft deletes, and `belongsTo User` relationship

## 3. Service Layer

- [x] 3.1 Create `PatientService` in `app/Services/PatientService.php`
- [x] 3.2 Implement `index()` — return all patients
- [x] 3.3 Implement `store()` — create patient
- [x] 3.4 Implement `show()` — find by id or fail
- [x] 3.5 Implement `update()` — update patient fields
- [x] 3.6 Implement `destroy()` — soft delete
- [x] 3.7 Implement `search()` — query by first_name or last_name using LIKE

## 4. Form Requests

- [x] 4.1 Create `StorePatientRequest` with validation for all fields
- [x] 4.2 Create `UpdatePatientRequest` with `sometimes` rules

## 5. API Resource

- [x] 5.1 Create `PatientResource` exposing all patient fields

## 6. Controller

- [x] 6.1 Create `PatientController` in `app/Http/Controllers/Api/PatientController.php`
- [x] 6.2 Implement `index()` — delegate to PatientService
- [x] 6.3 Implement `store()` — validate, delegate to PatientService, return resource (201)
- [x] 6.4 Implement `show()` — delegate to PatientService
- [x] 6.5 Implement `update()` — validate, delegate to PatientService
- [x] 6.6 Implement `destroy()` — delegate to PatientService, return JSON (200)
- [x] 6.7 Implement `search()` — delegate to PatientService

## 7. Routes

- [x] 7.1 Add all patient routes inside `auth:sanctum` group (search before `{patient}`)
