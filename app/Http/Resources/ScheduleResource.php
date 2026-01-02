<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            'title' => $this->title,
            'shift' => $this->whenLoaded('list')->sortBy('week_number')->map(function($list){
                return [
                    'week' => $list->week_number,
                    'start' => $list->shifts->first()?->start_time,
                    'end' => $list->shifts->first()?->end_time,
                    'day_of_week' => $list->shifts->first()?->day_of_week,
                ];
            })->toArray()
        ];
    }
}
