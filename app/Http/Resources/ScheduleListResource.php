<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->id,
            'schedule_id' => $this?->schedule_id,
            'shift_id' => $this?->shift_id,
            'week_number' => $this->week_number,
            'schedule' => $this->whenLoaded('schedule'),
            'shifts' => $this->whenLoaded('shifts'),
        ];
    }
}
