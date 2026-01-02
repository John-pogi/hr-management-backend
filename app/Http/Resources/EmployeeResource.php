<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'fullname' => $this->fullname ?? 'Cruz O\'Keefe',
            'email' => $this->email ?? 'travis.rippin@example.org',
            'position' => $this->position ?? 'Compensation and Benefits Manager',
            'contact' => $this->contact ?? '(843) 688-7435',
            'department' => $this->whenLoaded('deparment'),
            'company' => $this->whenLoaded('company'),
        ];
    }

}
