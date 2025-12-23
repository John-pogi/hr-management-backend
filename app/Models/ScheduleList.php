<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleList extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleListFactory> */
    use HasFactory;

      use HasFactory;

    protected $fillable = [
        'schedule_id',
        'shift_id',
        'week_number',
    ];

    protected $casts = [
        'week_number' => 'integer',
    ];

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }
}
