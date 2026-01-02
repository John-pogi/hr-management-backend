<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function list(): HasMany{
        return $this->hasMany(ScheduleList::class);
    }

    public function getWeekList($weekNumber){
        return $this->list->Where('week_number', $weekNumber);
    }

}
