## 1. Database & Enum

- [x] 1.1 Create `AppointmentStatusEnum` in `app/Enums/AppointmentStatusEnum.php` with `scheduled`, `completed`, `cancelled` cases
- [x] 1.2 Create migration `create_appointments_table` with `patient_id` FK, `appointment_date`, `appointment_time`, `reason`, `status`, `softDeletes`
- [x] 1.3 Run migrations

## 2. Model

- [x] 2.1 Create `Appointment` model with fillable, casts, soft deletes, and `belongsTo Patient` relationship

## 3. Service Layer

- [x] 3.1 Create `AppointmentService` in `app/Services/AppointmentService.php`
- [x] 3.2 Implement `index()` — return all appointments with optional filters (status, date_from, date_to)
- [x] 3.3 Implement `store()` — create appointment
- [x] 3.4 Implement `show()` — find by id or fail
- [x] 3.5 Implement `update()` — update appointment fields
- [x] 3.6 Implement `destroy()` — soft delete

## 4. Form Requests

- [x] 4.1 Create `StoreAppointmentRequest` with validation for all fields
- [x] 4.2 Create `UpdateAppointmentRequest` with validation rules

## 5. API Resource

- [x] 5.1 Create `AppointmentResource` exposing all appointment fields with nested patient data

## 6. Controller

- [x] 6.1 Create `AppointmentController` in `app/Http/Controllers/Api/AppointmentController.php`
- [x] 6.2 Implement `index()` — delegate to AppointmentService with filter query params
- [x] 6.3 Implement `store()` — validate, delegate to AppointmentService, return resource (201)
- [x] 6.4 Implement `show()` — delegate to AppointmentService
- [x] 6.5 Implement `update()` — validate, delegate to AppointmentService
- [x] 6.6 Implement `destroy()` — delegate to AppointmentService, return JSON (200)

## 7. Routes

- [x] 7.1 Add appointment routes inside `auth:sanctum` group (explicit routes)
