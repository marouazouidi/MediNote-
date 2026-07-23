## Why

Without appointment management, patients cannot be scheduled for consultations. Both doctors and assistants need to create, view, modify, and cancel appointments as part of the daily practice workflow. Appointments serve as the trigger to start consultations.

## What Changes

- Create `AppointmentStatusEnum` with `scheduled`, `completed`, `cancelled` cases
- Create `appointments` migration with `patient_id` FK, `appointment_date`, `appointment_time`, `reason`, `status`, and soft deletes
- Create `Appointment` model with `belongsTo Patient` relation
- Create `AppointmentService` for CRUD + filtering
- Create form requests (`StoreAppointmentRequest`, `UpdateAppointmentRequest`)
- Create `AppointmentResource`
- Create `AppointmentController` with index, store, show, update, destroy
- Add routes under `/api/appointments` in the `auth:sanctum` group
- Add date and status filtering on the index endpoint

## Capabilities

### New Capabilities
- `appointment-management`: Schedule, update, cancel, and view appointments with date and status filtering

### Modified Capabilities
- (none)

## Impact

- New DB table: `appointments` (FK `patient_id` → patients)
- New files: enum, migration, model, service, controller, form requests, resource
- New routes: `GET|POST /api/appointments`, `GET|PUT|DELETE /api/appointments/{appointment}`
- All endpoints protected by `auth:sanctum`
- Both `doctor` and `assistant` roles can manage appointments
