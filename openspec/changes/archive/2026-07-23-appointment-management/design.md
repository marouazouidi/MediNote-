## Context

The patient-management feature established the project's CRUD pattern: Migration → Model → Service → Form Request → Resource → Controller → Routes. Appointment management follows the same pattern with the addition of status and date filtering.

The Appointment entity is the bridge between Patient and future Consultation features. It has a simple relationship: `Appointment belongsTo Patient`.

## Goals / Non-Goals

**Goals:**
- Full CRUD for appointments under `auth:sanctum`
- Filtering by date range and status
- Soft deletes for cancellation traceability
- Consistent with patient-management architecture

**Non-Goals:**
- No consultation linking yet (future feature)
- No calendar UI (frontend concern)
- No recurring appointments

## Decisions

- **AppointmentStatusEnum** instead of raw strings — consistent with `GenderEnum` and `RoleEnum`
- **Soft deletes** instead of hard delete — cancellation history is useful for auditing
- **Filtering via query params** on the index endpoint (`?status=scheduled&date_from=2026-07-01&date_to=2026-07-31`) — keeps the API simple without a separate search endpoint
- **No user_id FK** — appointments belong to patients, not to users. Authorization is implicit (any authenticated user can manage any appointment)
- **Same patterns as patient-management** — Service Layer, Form Requests, API Resources, Dependency Injection

## Risks / Trade-offs

- [No user ownership] → Any authenticated user can modify any appointment. Acceptable for a small practice; add a Policy if multi-doctor isolation is needed later.
- [Soft deletes on a scheduling entity] → Cancelled appointments remain in the DB. Ensures audit trail but may need periodic cleanup for very old records.
