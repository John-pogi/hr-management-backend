<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class ScheduleCalendarController extends Controller
{
    public function index(Request $request, Schedule $schedule){

        $startDay = new Carbon($request->date)->firstOfMonth();
        $endDay = new Carbon($request->date)->endOfMonth();

        $month = CarbonPeriod::create($startDay,'1 day', $endDay);

        $calendar = [];

        /** @var Carbon $day */
        foreach($month as $day){
            $currentWeek = $day->weekOfMonth();

            $scheduleList = $schedule->getWeekList($currentWeek);

            
            foreach($scheduleList as $list){
                
                
                $shift = $list->getCurrentShift($day->shortDayName);

                if(isset($shift)){
                    
                    $isNextDay =  Carbon::now()->setTimeFrom($shift->start_time)->gte( Carbon::now()->setTimeFrom($shift->end_time));

                    $calendar[] = [
                        'day' => $day->format('Y-m-d'),
                        'day_name' => $day->dayName,
                        'start' => $day->copy()->setTimeFrom($shift->start_time)->format('Y-m-d H:i:m'),
                        'end' => $day->copy()->addDays($isNextDay ? 1 : 0)->setTimeFrom($shift->end_time)->format('Y-m-d H:i:m'),
                    ];

                    break;
                }
            }
        }


        return response()->json(['month'=> $startDay->format('Y-m'), 'data' => $calendar]);
    }
}
