<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarInsuranceInfoResource extends JsonResource
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
            'carrier' => $this->carrier,
            'policy_number' => $this->policy_number,
            'car_insurance_info_images' => $this->carInsuranceInfoImages->pluck('image'), // Only images
        ];
    }
}
