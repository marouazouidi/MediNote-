<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Patient;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(
        protected PatientService $patientService
    ) {}

    /**
     * List all patients.
     *
     * Retrieves a paginated list of patients belonging to the authenticated user. The results are ordered by creation date, with the most recent patients appearing first.
     *
     * @group Patients
     *
     * @authenticated
     *
     * @response {
     *   "data": [
     *     {
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
     *     }
     *   ]
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function index()
    {
        $this->authorize('viewAny', Patient::class);

        return PatientResource::collection(
            $this->patientService->index()
        );
    }

    /**
     * Search patients by term.
     *
     * Searches the authenticated user's patients by matching the given term against the first name, last name, phone number, or address. Results are returned as a paginated list.
     *
     * @group Patients
     *
     * @authenticated
     *
     * @queryParam q string required The search term. Example: Marie
     *
     * @response {
     *   "data": [
     *     {
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
     *     }
     *   ]
     * }
     * @response status=422 {
     *   "message": "The q field is required.",
     *   "errors": {
     *     "q": ["The q field is required."]
     *   }
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function search(Request $request)
    {
        $this->authorize('viewAny', Patient::class);

        $request->validate(['q' => 'required|string|max:255']);

        return PatientResource::collection(
            $this->patientService->search($request->q)
        );
    }

    /**
     * Create a new patient.
     *
     * Registers a new patient record associated with the authenticated user. The patient information includes personal details, contact information, and known allergies.
     *
     * @group Patients
     *
     * @authenticated
     *
     * @bodyParam first_name string required The first name of the patient. Example: Marie
     * @bodyParam last_name string required The last name of the patient. Example: Curie
     * @bodyParam birth_date string nullable The birth date of the patient. Example: 1990-05-15
     * @bodyParam gender string required The gender of the patient. Must be one of: male, female. Example: female
     * @bodyParam phone string nullable The phone number of the patient. Example: +33612345678
     * @bodyParam address string nullable The home address of the patient. Example: 12 Rue de la Paix, Paris
     * @bodyParam allergies string nullable A description of the patient's known allergies. Example: Penicillin
     *
     * @response status=201 {
     *   "data": {
     *     "id": 1,
     *     "first_name": "Marie",
     *     "last_name": "Curie",
     *     "birth_date": "1990-05-15",
     *     "gender": "female",
     *     "phone": "+33612345678",
     *     "address": "12 Rue de la Paix, Paris",
     *     "allergies": "Penicillin",
     *     "created_at": "2026-08-07T10:00:00.000000Z",
     *     "updated_at": "2026-08-07T10:00:00.000000Z"
     *   }
     * }
     * @response status=422 {
     *   "message": "The first name field is required.",
     *   "errors": {
     *     "first_name": ["The first name field is required."]
     *   }
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(StorePatientRequest $request)
    {
        $this->authorize('create', Patient::class);

        $patient = $this->patientService->store($request->validated());

        return (new PatientResource($patient))->response()->setStatusCode(201);
    }

    /**
     * Show a patient.
     *
     * Retrieves the complete details of a specific patient belonging to the authenticated user, including personal information, contact details, and medical allergies.
     *
     * @group Patients
     *
     * @authenticated
     *
     * @urlParam patient integer required The unique identifier of the patient. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "first_name": "Marie",
     *     "last_name": "Curie",
     *     "birth_date": "1990-05-15",
     *     "gender": "female",
     *     "phone": "+33612345678",
     *     "address": "12 Rue de la Paix, Paris",
     *     "allergies": "Penicillin",
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
    public function show(Patient $patient)
    {
        $this->authorize('view', $patient);

        return new PatientResource(
            $this->patientService->show($patient)
        );
    }

    /**
     * Update a patient.
     *
     * Updates the details of an existing patient belonging to the authenticated user. All fields except those marked as nullable must be provided.
     *
     * @group Patients
     *
     * @authenticated
     *
     * @urlParam patient integer required The unique identifier of the patient. Example: 1
     *
     * @bodyParam first_name string required The updated first name of the patient. Example: Marie
     * @bodyParam last_name string required The updated last name of the patient. Example: Curie
     * @bodyParam birth_date string nullable The updated birth date of the patient. Example: 1990-05-15
     * @bodyParam gender string required The updated gender of the patient. Must be one of: male, female. Example: female
     * @bodyParam phone string nullable The updated phone number of the patient. Example: +33612345678
     * @bodyParam address string nullable The updated home address of the patient. Example: 12 Rue de la Paix, Paris
     * @bodyParam allergies string nullable The updated description of the patient's known allergies. Example: Penicillin
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "first_name": "Marie",
     *     "last_name": "Curie",
     *     "birth_date": "1990-05-15",
     *     "gender": "female",
     *     "phone": "+33612345678",
     *     "address": "12 Rue de la Paix, Paris",
     *     "allergies": "Penicillin",
     *     "created_at": "2026-08-07T10:00:00.000000Z",
     *     "updated_at": "2026-08-07T11:00:00.000000Z"
     *   }
     * }
     * @response status=422 {
     *   "message": "The gender field is required.",
     *   "errors": {
     *     "gender": ["The gender field is required."]
     *   }
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $this->authorize('update', $patient);

        $patient = $this->patientService->update($patient, $request->validated());

        return new PatientResource($patient);
    }

    /**
     * Delete a patient.
     *
     * Soft-deletes an existing patient belonging to the authenticated user. The record is marked as deleted but remains in the database for auditing purposes.
     *
     * @group Patients
     *
     * @authenticated
     *
     * @urlParam patient integer required The unique identifier of the patient. Example: 1
     *
     * @response {
     *   "message": "Patient deleted successfully"
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function destroy(Patient $patient)
    {
        $this->authorize('delete', $patient);

        $this->patientService->destroy($patient);

        return response()->json(['message' => 'Patient deleted successfully']);
    }
}
