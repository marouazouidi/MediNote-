<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct(
        protected AppointmentService $appointmentService
    ) {}

    public function index(Request $request)
    {
        $appointments = $this->appointmentService->index($request->only([
            'status', 'date_from', 'date_to',
        ]));

        return AppointmentResource::collection($appointments);
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = $this->appointmentService->store($request->validated());

        return (new AppointmentResource($appointment))->response()->setStatusCode(201);
    }

    public function show(Appointment $appointment)
    {
        return new AppointmentResource(
            $this->appointmentService->show($appointment)
        );
    }

    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $appointment = $this->appointmentService->update($appointment, $request->validated());

        return new AppointmentResource($appointment);
    }

    public function destroy(Appointment $appointment)
    {
        $this->appointmentService->destroy($appointment);

        return response()->json(['message' => 'Appointment cancelled successfully']);
    }
}
