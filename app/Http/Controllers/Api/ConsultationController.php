<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use App\Http\Resources\ConsultationResource;
use App\Services\ConsultationService;

class ConsultationController extends Controller
{
    public function __construct(
        protected ConsultationService $consultationService
    ) {}

    public function index()
    {
        return ConsultationResource::collection(
            $this->consultationService->index()
        );
    }

    public function store(StoreConsultationRequest $request)
    {
        $consultation = $this->consultationService->store($request->validated());

        return (new ConsultationResource($consultation))->response()->setStatusCode(201);
    }

    public function show(Consultation $consultation)
    {
        return new ConsultationResource(
            $this->consultationService->show($consultation)
        );
    }

    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {
        $consultation = $this->consultationService->update($consultation, $request->validated());

        return new ConsultationResource($consultation);
    }

    public function destroy(Consultation $consultation)
    {
        $this->consultationService->destroy($consultation);

        return response()->json(['message' => 'Consultation deleted successfully']);
    }
}