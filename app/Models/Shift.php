<?php

namespace App\Models;

use App\Utils\DayNameParser;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Shift extends Model
{
    /** @use HasFactory<\Database\Factories\ShiftFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'day_of_week',
        'flag',
    ];

    protected $casts = [
        'flag'        => 'boolean',
    ];

    public function weekSchedule($date, $week){
        
        $schedule = new Carbon($date)->weekOfMonth($week);

        $periods = CarbonPeriod::create($schedule->copy()->startOfWeek(),'1 day', $schedule);

        $allowedDays = DayNameParser::parseArray($this->day_of_week);
        
        $schedules = [];

        foreach ($periods as $period) {
            if(in_array($period->dayOfWeek, $allowedDays)){
                $schedules[$period->day] = [
                    'start' => $this->start_time,
                    'end' => $this->start_time,
                ];
            }
        }

        return $schedules;
    }

    protected function dayOfWeek(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => explode(',',$value), 
            set: fn (string $value) => $value, 
        );
    }
}
