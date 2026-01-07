<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return  [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'leave_type_id' => $this->leave_type_id,
            'leave_code_id' => $this->leave_code_id,
            'valid_credit' => (float) $this->valid_credit,
            'start_date' => $this->start_date?->format('Y-m-d'),
            'end_date' => $this->end_date?->format('Y-m-d'),
            'status' => $this->status,
            'credit' => (float) $this->credit,
            'notes' => $this->notes,
            'leave_type' => $this->whenLoaded('leaveType', function($data){
                return [
                        'id' => $data->id,
                        'name' => $data->name,
                        'credit' => $data->credit,
                ];
            })
        ];
    }
}
