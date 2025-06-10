<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HealthInsurenceInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'medi_care' => $this->medi_care,
            'policy_number' => $this->policy_number,
            'insurer_name' => $this->insurer_name,
            'insurance_carrier' => $this->insurance_carrier,
            'health_insurance_images' => $this->healthInsuranceImages->pluck('image')->toArray(),
        ];
    }
}
