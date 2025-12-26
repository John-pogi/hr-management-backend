<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ScheduleList extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleListFactory> */
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'week_number',
    ];

    protected $casts = [
        'week_number' => 'integer',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function shifts(): BelongsToMany{
        return $this->belongsToMany(Shift::class, 'shiftables', 'schedule_list_id', 'shift_id');
    }

    public function getCurrentShift($dayName){
        return $this->shifts->filter(function ($shift) use($dayName) {
            return in_array($dayName, $shift->day_of_week);
        })->first();
    }

}
