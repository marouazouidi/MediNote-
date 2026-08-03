<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConsultationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'text_brut_id'    => $this->text_brut_id,
            'text_brut'       => new TextBrutResource($this->whenLoaded('textBrut')),
            'chief_complaint' => $this->chief_complaint,
            'symptoms'        => $this->symptoms,
            'observations'    => $this->observations,
            'diagnosis'       => $this->diagnosis,
            'follow_up_date'  => $this->follow_up_date,
            'validated_at'    => $this->validated_at,
            'prescriptions'   => PrescriptionResource::collection($this->whenLoaded('prescriptions')),
            'created_at'      => $this->created_at,
            'updated_at'      => $this->updated_at,
        ];
    }
}