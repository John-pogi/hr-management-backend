<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DTRResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->id,
            "date" =>  $this?->date,
            "time" =>  $this?->time,
            "type" =>  $this?->employee_id,
            'employee' => $this->whenLoaded('employee', fn () => [
                'id' => $this->employee->id,
                'name' => $this->employee->fullname,
                'company_id' => $this->employee->company?->id,
                'company_name' => $this->employee->company?->name,
                'department_id' => $this->employee->deparment?->id,
                'department_name' => $this->employee->deparment?->name,
            ])
        ];
    }
}
