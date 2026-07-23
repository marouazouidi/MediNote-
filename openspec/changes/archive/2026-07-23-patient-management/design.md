## Context

The app currently only has user authentication. No Patient model, migration, controller, or routes exist. Both doctors and assistants need to manage patient records before scheduling appointments or starting consultations.

## Goals / Non-Goals

**Goals:**
- Create patients table and model with soft deletes
- Expose full CRUD + search via REST API
- Authenticate all endpoints with Laravel Sanctum
- Follow existing service layer architecture

**Non-Goals:**
- Patient-doctor ownership logic (all users see all patients)
- Appointment or consultation integration (scoped separately)

## Decisions

- **Soft deletes** on patients for data safety and auditability
- **GenderEnum** with `male`, `female` — simple string-backed enum stored as varchar
- **PatientService** handles all CRUD + search — keeps controller thin
- **Form Requests** separate for store and update — update uses `sometimes` for partial updates
- **Search route before `{patient}`** — avoids route model binding conflict
- **Search queries by first_name and last_name** — uses `LIKE %keyword%` on both columns
- **All authenticated users** can manage all patients — no policy needed per current requirements

## Risks / Trade-offs

- [Search uses LIKE] → Simple and sufficient for current scope. For large datasets, add full-text indexing later.
- [No pagination on list] → Add pagination when volume grows
