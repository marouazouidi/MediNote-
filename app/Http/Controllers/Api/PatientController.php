<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Resources\PatientResource;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function __construct(
        protected PatientService $patientService
    ) {}

    public function index()
    {
        return PatientResource::collection(
            $this->patientService->index()
        );
    }

    public function search(Request $request)
    {
        $request->validate(['q' => 'required|string|max:255']);

        return PatientResource::collection(
            $this->patientService->search($request->q)
        );
    }

    public function store(StorePatientRequest $request)
    {
        $patient = $this->patientService->store($request->validated());

        return (new PatientResource($patient))->response()->setStatusCode(201);
    }

    public function show(Patient $patient)
    {
        return new PatientResource(
            $this->patientService->show($patient)
        );
    }

    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient = $this->patientService->update($patient, $request->validated());

        return new PatientResource($patient);
    }

    public function destroy(Patient $patient)
    {
        $this->patientService->destroy($patient);

        return response()->json(['message' => 'Patient deleted successfully']);
    }
}
