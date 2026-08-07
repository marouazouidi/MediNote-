<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnalyzeTextBrutRequest;
use App\Http\Requests\StoreTextBrutRequest;
use App\Http\Requests\UpdateTextBrutRequest;
use App\Http\Requests\ValidateTextBrutRequest;
use App\Http\Resources\ConsultationResource;
use App\Http\Resources\TextBrutResource;
use App\Models\TextBrut;
use App\Services\TextBrutService;

class TextBrutController extends Controller
{
    public function __construct(
        protected TextBrutService $textBrutService
    ) {}

    /**
     * Create a new text brut.
     *
     * Stores a free-text medical note written by the doctor and links it to an existing appointment. Each appointment can only have one associated text brut. Only doctors can create text bruts.
     *
     * @group Text Bruts
     *
     * @authenticated
     *
     * @bodyParam appointment_id integer required The identifier of the appointment this note belongs to. Must be unique. Example: 1
     * @bodyParam content string required The free-text medical note written by the doctor. Example: Patient presents with persistent headache and mild fever for the past two days.
     *
     * @response status=201 {
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "doctor": {
     *       "id": 1,
     *       "name": "Dr. Jane Doe",
     *       "email": "doctor@example.com",
     *       "role": "doctor",
     *       "created_at": "2026-08-07T10:00:00.000000Z"
     *     },
     *     "appointment_id": 1,
     *     "appointment": [],
     *     "content": "Patient presents with persistent headache and mild fever for the past two days.",
     *     "analysis_status": "pending",
     *     "created_at": "2026-08-07T10:00:00.000000Z",
     *     "updated_at": "2026-08-07T10:00:00.000000Z"
     *   }
     * }
     * @response status=422 {
     *   "message": "The content field is required.",
     *   "errors": {
     *     "content": ["The content field is required."]
     *   }
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function store(StoreTextBrutRequest $request)
    {
        $this->authorize('create', TextBrut::class);

        $textBrut = $this->textBrutService->store($request->validated());

        return (new TextBrutResource($textBrut))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Show a text brut.
     *
     * Retrieves the details of a specific text brut belonging to the authenticated doctor, including the associated appointment, content, and current analysis status.
     *
     * @group Text Bruts
     *
     * @authenticated
     *
     * @urlParam textBrut integer required The unique identifier of the text brut. Example: 1
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "doctor": {
     *       "id": 1,
     *       "name": "Dr. Jane Doe",
     *       "email": "doctor@example.com",
     *       "role": "doctor",
     *       "created_at": "2026-08-07T10:00:00.000000Z"
     *     },
     *     "appointment_id": 1,
     *     "appointment": [],
     *     "content": "Patient presents with persistent headache and mild fever for the past two days.",
     *     "analysis_status": "pending",
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
    public function show(TextBrut $textBrut)
    {
        $this->authorize('view', $textBrut);

        return new TextBrutResource(
            $this->textBrutService->show($textBrut)
        );
    }

    /**
     * Update a text brut.
     *
     * Updates the content of an existing text brut belonging to the authenticated doctor. Once the text brut has been analyzed or validated, it can no longer be modified.
     *
     * @group Text Bruts
     *
     * @authenticated
     *
     * @urlParam textBrut integer required The unique identifier of the text brut. Example: 1
     *
     * @bodyParam content string nullable The updated free-text medical note. Example: Updated note: patient reports improved symptoms after medication.
     *
     * @response {
     *   "data": {
     *     "id": 1,
     *     "user_id": 1,
     *     "doctor": [],
     *     "appointment_id": 1,
     *     "appointment": [],
     *     "content": "Updated note: patient reports improved symptoms after medication.",
     *     "analysis_status": "pending",
     *     "created_at": "2026-08-07T10:00:00.000000Z",
     *     "updated_at": "2026-08-07T11:00:00.000000Z"
     *   }
     * }
     * @response status=422 {
     *   "message": "The text can no longer be modified after AI analysis.",
     *   "errors": {
     *     "analysis_status": ["The text can no longer be modified after AI analysis."]
     *   }
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function update(UpdateTextBrutRequest $request, TextBrut $textBrut)
    {
        $this->authorize('update', $textBrut);

        $textBrut = $this->textBrutService->update($textBrut, $request->validated());

        return new TextBrutResource($textBrut);
    }

    /**
     * Analyze a text brut with AI.
     *
     * Triggers an asynchronous AI analysis of the text brut content. The AI extracts structured medical information including the consultation reason, symptoms, observations, diagnosis, prescriptions, and follow-up recommendations. The text brut status changes to "pending" and then to "analyzed" once processing completes. Only doctors can trigger analysis.
     *
     * @group AI Analysis
     *
     * @authenticated
     *
     * @urlParam textBrut integer required The unique identifier of the text brut to analyze. Example: 1
     *
     * @response status=202 {
     *   "message": "AI analysis started."
     * }
     * @response status=422 {
     *   "message": "The AI analysis has already been completed.",
     *   "errors": {
     *     "analysis_status": ["The AI analysis has already been completed."]
     *   }
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function analyze(AnalyzeTextBrutRequest $request, TextBrut $textBrut)
    {
        $this->authorize('analyze', $textBrut);

        $this->textBrutService->analyze($textBrut);

        return response()->json([
            'message' => 'AI analysis started.',
        ], 202);
    }

    /**
     * Validate a text brut.
     *
     * Validates the AI-analyzed text brut and persists the structured medical information as a consultation record. Once validated, the text brut status changes to "validated" and can no longer be modified. Only doctors can validate a text brut.
     *
     * @group AI Analysis
     *
     * @authenticated
     *
     * @urlParam textBrut integer required The unique identifier of the text brut to validate. Example: 1
     *
     * @response status=201 {
     *   "data": {
     *     "id": 1,
     *     "text_brut_id": 1,
     *     "text_brut": [],
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
     * @response status=422 {
     *   "message": "The AI analysis has not finished yet.",
     *   "errors": {
     *     "analysis_status": ["The AI analysis has not finished yet."]
     *   }
     * }
     * @response status=403 {
     *   "message": "This action is unauthorized."
     * }
     * @response status=401 {
     *   "message": "Unauthenticated."
     * }
     */
    public function validate(ValidateTextBrutRequest $request, TextBrut $textBrut)
    {
        $this->authorize('validate', $textBrut);

        $consultation = $this->textBrutService->validate($textBrut);

        return (new ConsultationResource($consultation))
            ->response()
            ->setStatusCode(201);
    }
}
