<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'consultation_id' => $this->consultation_id,
            'medication_name' => $this->medication_name,
            'dosage'          => $this->dosage,
            'frequency'       => $this->frequency,
            'duration'        => $this->duration,
            'instructions'    => $this->instructions,
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }
}
