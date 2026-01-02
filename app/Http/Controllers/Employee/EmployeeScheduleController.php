<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\IrregEmployeeSchedule;
use App\Models\Leave;
use App\Models\ScheduleList;
use App\Models\Shift;
use App\Utils\DayNameParser;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class EmployeeScheduleController extends Controller
{
      public function index(Request $request, Employee $employee){

        $date = $request->input('date');
        $status = $request->input('status');
        $type = $request->input('type');

        $carbonDate = Carbon::now();

        $irregSchedule = IrregEmployeeSchedule::with(['schedule', 'schedule.list', 'schedule.list.shifts'  ])->where('employee_id', $employee->id)
            ->whereRaw('EXTRACT(MONTH FROM date) = ?', [$carbonDate->month])
            ->whereRaw('EXTRACT(YEAR FROM date) = ?', [$carbonDate->year])
            ->first();

        $hasIregguralSchedule = isset($irregSchedule);

        $schedules = [];

        $period = CarbonPeriod::create(
            Carbon::now()->firstOfMonth(),
            '1 day',
            Carbon::now()->lastOfMonth(),
        );

        foreach ($period as $date) {
            $schedules[] = $date->day;
        }

        return $schedules;

        // dd($irregSchedule->schedule->list->get(2)->shifts->first->weekSchedule(1,1));

        // dd(Shift::find(1)->weekSchedule(null,4));

        // $schedule = Carbon::now()->weekOfMonth(2);

        // $periods = CarbonPeriod::create($schedule->copy()->startOfWeek(),'1 day', $schedule);

        // $allowedDays = DayNameParser::parseArray(['mon','tue','wed']);
        
        // foreach ($periods as $period) {
        //     if(in_array($period->dayOfWeek, $allowedDays)){
        //         echo $period->day . "</br>";
        //     }
        // }

        // dd($period);

        // return $irregSchedule->schedule->list->first()->shifts; m

        // return Leave::whereHas('employee.supervisor', function($qb) use($employee){
        //         $qb->where('employee_id', $employee->id);
        //     })
        //     ->where('employee_id','!=', $employee->id)
        //     ->when($date, function($qb)use($date){
        //             $qb->where('date',$date);
        //         })
        //     ->when($status, function($qb)use($status){
        //         $qb->where('status',$status);
        //     })
        //     ->when($type, function($qb)use($type){
        //         $qb->where('leave_type_id',$type);
        //     })
        //     ->paginate(20);
    }
}
