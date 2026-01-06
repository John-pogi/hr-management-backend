<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EOMResource extends JsonResource
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
            'employee_id' => $this->employee_id,
            'date' => $this->date?->format('Y-m-d'), // ISO 8601 format
            'date_in' => $this->date_in?->format('Y-m-d'),
            'date_out' => $this->date_out?->format('Y-m-d'),
            'time_in' => $this->time_in->format('H:i:s'),
            'time_out' => $this->time_out->format('H:i:s'),
            'total_minutes' => $this->total_minutes,
            'under_time_minutes' => $this->under_time_minutes,
            'regular_minutes' => $this->regular_minutes,
            'late_minutes' => $this->late_minutes,
            'overtime_minutes' => $this->overtime_minutes,
            'leave_credit' => $this->leave_credit,
            'approved_overtime' => $this->approved_overtime,
            'shift_start' => $this->shift_start,
            'shift_end' => $this->shift_end,
             'employee' => $this->whenLoaded('employee', fn () => [
                'id' => $this->employee->id,
                'name' => $this->employee->fullname,
                'employee_number' => $this->employee?->employee_number,
                'company_id' => $this->employee->company?->id,
                'company_name' => $this->employee->company?->name,
                'department_id' => $this->employee->deparment?->id,
                'department_name' => $this->employee->deparment?->name,
            ])
        ];
    }
}
