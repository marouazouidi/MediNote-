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

    /**
     * List all consultations.
     *
     * Retrieves a paginated list of validated consultations belonging to the authenticated user. Each consultation contains structured medical information extracted by the AI from the original text brut.
     *
     * @group Consultations
     *
     * @authenticated
     *
     * @response {
     *   "data": [
     *     {
     *       "id": 1,
     *       "text_brut_id": 1,
     *       "text_brut": [],
     *       "chief_complaint": "Headache",
     *       "symptoms": ["Headache", "Fever"],
     *       "observations": "Patient presents with persistent headache and mild fever for the past two days.",
     *       "diagnosis": "Viral infection",
     *       "follow_up_date": "2026-09-01",
     *       "validated_at": "2026-08-07T10:05:00.000000Z",
     *       "prescriptions": [
     *         {
     *           "medication_name": "Ibuprofen",
     *           "dosage": "400mg",
     *           "frequency": "3x/day",
     *           "duration": "5 days",
     *           "instructions": null
     *         }
     *       ],
     *       "created_at": "2026-08-07T10:05:00.000000Z",
     *       "updated_at": "2026-08-07T10:05:00.000000Z"
     *     }
     *   ]
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function index()
    {
        $this->authorize('viewAny', Consultation::class);

        return ConsultationResource::collection(
            $this->consultationService->index()
        );
    }

    /**
     * Show a consultation.
     *
     * Retrieves the details of a specific validated consultation belonging to the authenticated user, including the linked text brut, extracted medical information, diagnosis, and prescriptions.
     *
     * @group Consultations
     *
     * @authenticated
     *
     * @urlParam consultation integer required The unique identifier of the consultation. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "text_brut_id": 1,
     *     "text_brut": {
     *       "id": 1,
     *       "user_id": 1,
     *       "content": "Patient presents with persistent headache and mild fever for the past two days.",
     *       "analysis_status": "validated"
     *     },
     *     "chief_complaint": "Headache",
     *     "symptoms": ["Headache", "Fever"],
     *     "observations": "Patient presents with persistent headache and mild fever for the past two days.",
     *     "diagnosis": "Viral infection",
     *     "follow_up_date": "2026-09-01",
     *     "validated_at": "2026-08-07T10:05:00.000000Z",
     *     "prescriptions": [
     *       {
     *         "medication_name": "Ibuprofen",
     *         "dosage": "400mg",
     *         "frequency": "3x/day",
     *         "duration": "5 days",
     *         "instructions": null
     *       }
     *     ],
     *     "created_at": "2026-08-07T10:05:00.000000Z",
     *     "updated_at": "2026-08-07T10:05:00.000000Z"
     *   }
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function show(Consultation $consultation)
    {
        $this->authorize('view', $consultation);

        return new ConsultationResource(
            $this->consultationService->show($consultation)
        );
    }
}
