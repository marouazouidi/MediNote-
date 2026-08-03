<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConsultationResource;
use App\Models\Consultation;
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

    public function show(Consultation $consultation)
    {
        return new ConsultationResource(
            $this->consultationService->show($consultation)
        );
    }
}
