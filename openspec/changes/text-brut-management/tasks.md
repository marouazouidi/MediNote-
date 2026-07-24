## 1. Database & Enum

- [x] 1.1 Create `AnalysisStatusEnum` in `app/Enums/AnalysisStatusEnum.php` with `pending`, `processing`, `completed`, `failed` cases
- [x] 1.2 Create migration `create_text_bruts_table` with `appointment_id` FK (unique), `content`, `analysis_status`
- [x] 1.3 Run migrations

## 2. Model

- [x] 2.1 Create `TextBrut` model with fillable, casts, and `belongsTo Appointment` relationship
- [x] 2.2 Add `hasOne TextBrut` relationship to `Appointment` model

## 3. Service Layer

- [x] 3.1 Create `TextBrutService` in `app/Services/TextBrutService.php`
- [x] 3.2 Implement `store()` — create TextBrut
- [x] 3.3 Implement `show()` — find by id or fail
- [x] 3.4 Implement `update()` — update TextBrut fields

## 4. Form Requests

- [x] 4.1 Create `StoreTextBrutRequest` with validation for all fields (unique appointment_id)
- [x] 4.2 Create `UpdateTextBrutRequest` with validation rules

## 5. API Resource

- [x] 5.1 Create `TextBrutResource` exposing all TextBrut fields with nested appointment data

## 6. Controller

- [x] 6.1 Create `TextBrutController` in `app/Http/Controllers/Api/TextBrutController.php`
- [x] 6.2 Implement `store()` — validate, delegate to TextBrutService, return resource (201)
- [x] 6.3 Implement `show()` — delegate to TextBrutService
- [x] 6.4 Implement `update()` — validate, delegate to TextBrutService

## 7. Routes

- [x] 7.1 Add TextBrut routes (store, show, update) inside `auth:sanctum` group
