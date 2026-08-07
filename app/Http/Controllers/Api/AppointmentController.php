<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct(
        protected AppointmentService $appointmentService
    ) {}

    /**
     * List all appointments.
     *
     * Retrieves a paginated list of appointments belonging to the authenticated user. Results can be filtered by status and date range.
     *
     * @group Appointments
     *
     * @authenticated
     *
     * @queryParam status string Optional filter by appointment status. Must be one of: scheduled, completed, cancelled. Example: scheduled
     * @queryParam date_from string Optional start date filter (YYYY-MM-DD). Example: 2026-01-01
     * @queryParam date_to string Optional end date filter (YYYY-MM-DD). Example: 2026-12-31
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "patient_id": 1,
     *       "patient": {
     *         "id": 1,
     *         "first_name": "Marie",
     *         "last_name": "Curie"
     *       },
     *       "appointment_date": "2026-09-15",
     *       "appointment_time": "10:30",
     *       "reason": "Annual medical check-up",
     *       "status": "scheduled",
     *       "created_at": "2026-08-07T10:00:00.000000Z",
     *       "updated_at": "2026-08-07T10:00:00.000000Z"
     *     }
     *   ]
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Appointment::class);

        $appointments = $this->appointmentService->index($request->only([
            'status', 'date_from', 'date_to',
        ]));

        return AppointmentResource::collection($appointments);
    }

    /**
     * Create a new appointment.
     *
     * Schedules a new appointment for an existing patient. The appointment date, time, and reason are required.
     *
     * @group Appointments
     *
     * @authenticated
     *
     * @bodyParam patient_id integer required The identifier of the patient. Example: 1
     * @bodyParam appointment_date string required The date of the appointment. Example: 2026-09-15
     * @bodyParam appointment_time string required The time of the appointment in 24-hour format (HH:MM). Example: 10:30
     * @bodyParam reason string required The reason or purpose of the appointment. Example: Annual medical check-up
     * @bodyParam status string nullable The status of the appointment. Must be one of: scheduled, completed, cancelled. Example: scheduled
     *
     * @response status=201 {
     *   "data": {
     *     "id": 1,
     *     "patient_id": 1,
     *     "patient": [],
     *     "appointment_date": "2026-09-15",
     *     "appointment_time": "10:30",
     *     "reason": "Annual medical check-up",
     *     "status": "scheduled",
     *     "created_at": "2026-08-07T10:00:00.000000Z",
     *     "updated_at": "2026-08-07T10:00:00.000000Z"
     *   }
     * }
     * @response status=422 {
     *   "message": "The patient id field is required.",
     *   "errors": {
     *     "patient_id": ["The patient id field is required."]
     *   }
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(StoreAppointmentRequest $request)
    {
        $this->authorize('create', Appointment::class);

        $appointment = $this->appointmentService->store($request->validated());

        return (new AppointmentResource($appointment))->response()->setStatusCode(201);
    }

    /**
     * Show an appointment.
     *
     * Retrieves the complete details of a specific appointment belonging to the authenticated user, including the associated patient information.
     *
     * @group Appointments
     *
     * @authenticated
     *
     * @urlParam appointment integer required The unique identifier of the appointment. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "patient_id": 1,
     *     "patient": {
     *       "id": 1,
     *       "first_name": "Marie",
     *       "last_name": "Curie",
     *       "birth_date": "1990-05-15",
     *       "gender": "female",
     *       "phone": "+33612345678",
     *       "address": "12 Rue de la Paix, Paris",
     *       "allergies": "Penicillin",
     *       "created_at": "2026-08-07T10:00:00.000000Z",
     *       "updated_at": "2026-08-07T10:00:00.000000Z"
     *     },
     *     "appointment_date": "2026-09-15",
     *     "appointment_time": "10:30",
     *     "reason": "Annual medical check-up",
     *     "status": "scheduled",
     *     "created_at": "2026-08-07T10:00:00.000000Z",
     *     "updated_at": "2026-08-07T10:00:00.000000Z"
     *   }
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function show(Appointment $appointment)
    {
        $this->authorize('view', $appointment);

        return new AppointmentResource(
            $this->appointmentService->show($appointment)
        );
    }

    /**
     * Update an appointment.
     *
     * Updates the details of an existing appointment belonging to the authenticated user. Only the provided fields will be modified.
     *
     * @group Appointments
     *
     * @authenticated
     *
     * @urlParam appointment integer required The unique identifier of the appointment. Example: 1
     *
     * @bodyParam patient_id integer nullable The updated identifier of the patient. Example: 1
     * @bodyParam appointment_date string nullable The updated date of the appointment. Example: 2026-09-15
     * @bodyParam appointment_time string nullable The updated time of the appointment in 24-hour format (HH:MM). Example: 10:30
     * @bodyParam reason string nullable The updated reason or purpose of the appointment. Example: Follow-up consultation
     * @bodyParam status string nullable The updated status of the appointment. Must be one of: scheduled, completed, cancelled. Example: completed
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "patient_id": 1,
     *     "patient": [],
     *     "appointment_date": "2026-09-15",
     *     "appointment_time": "10:30",
     *     "reason": "Follow-up consultation",
     *     "status": "completed",
     *     "created_at": "2026-08-07T10:00:00.000000Z",
     *     "updated_at": "2026-08-07T11:00:00.000000Z"
     *   }
     * }
     * @response status=422 {
     *   "message": "The status field must be one of scheduled, completed, cancelled.",
     *   "errors": {
     *     "status": ["The status field must be one of scheduled, completed, cancelled."]
     *   }
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $this->authorize('update', $appointment);

        $appointment = $this->appointmentService->update($appointment, $request->validated());

        return new AppointmentResource($appointment);
    }

    /**
     * Delete an appointment.
     *
     * Soft-deletes an existing appointment belonging to the authenticated user. The record is marked as deleted but remains available for historical reference.
     *
     * @group Appointments
     *
     * @authenticated
     *
     * @urlParam appointment integer required The unique identifier of the appointment. Example: 1
     *
     * @response {
     *   "message": "Appointment cancelled successfully"
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function destroy(Appointment $appointment)
    {
        $this->authorize('delete', $appointment);

        $this->appointmentService->destroy($appointment);

        return response()->json(['message' => 'Appointment cancelled successfully']);
    }
}
