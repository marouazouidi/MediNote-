## Why

Without TextBrut, there is no place to store the physician's original free-text consultation note before AI processing. TextBrut preserves the raw medical note for auditing and traceability, keeping it independent from the AI-generated structured consultation.

## What Changes

- Create `AnalysisStatusEnum` with `pending`, `processing`, `completed`, `failed` cases
- Create `text_bruts` migration with `appointment_id` FK (unique), `content`, `analysis_status`, timestamps
- Create `TextBrut` model with `belongsTo Appointment` relationship
- Create `TextBrutService` with store, show, update (no index, no destroy)
- Create form requests (`StoreTextBrutRequest`, `UpdateTextBrutRequest`)
- Create `TextBrutResource`
- Create `TextBrutController` with store, show, update (no index, no destroy)
- Add `hasOne TextBrut` relationship to `Appointment` model
- Add routes under `/api/text-bruts` in the `auth:sanctum` group

## Capabilities

### New Capabilities
- `text-brut-management`: Store, view, and update raw consultation notes before AI processing

### Modified Capabilities
- `appointment-management`: Add `hasOne TextBrut` relationship (no spec-level behavior change)

## Impact

- New DB table: `text_bruts` (FK `appointment_id` → appointments, unique)
- New files: enum, migration, model, service, controller, form requests, resource
- Modified file: `app/Models/Appointment.php` (add `hasOne` relationship)
- New routes: `POST /api/text-bruts`, `GET|PUT /api/text-bruts/{text_brut}`
- No index (TextBrut is never listed independently)
- No destroy (TextBrut is never deleted)
- All endpoints protected by `auth:sanctum`
