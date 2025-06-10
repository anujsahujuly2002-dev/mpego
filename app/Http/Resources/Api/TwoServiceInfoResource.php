<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TwoServiceInfoResource extends JsonResource
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
            'membership_number' => $this->membership_number,
            'tow_contact_info' => $this->tow_contact_info,
            'emergency_contact_1' => $this->emergency_contact_1,
            'emergency_contact_2' => $this->emergency_contact_2,
            'tow_service_card' => $this->twoServiceImages->pluck('image'),
        ];
    }
}
