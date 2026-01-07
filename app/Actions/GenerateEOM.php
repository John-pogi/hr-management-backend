<?php

namespace App\Actions;

use App\Models\DTR;
use App\Models\Employee;
use App\Models\EOM;
use App\Models\IrregEmployeeSchedule;
use App\Models\Schedule;
use App\Models\ScheduleList;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Exception;

class GenerateEOM
{
    
    public function run($employeeID, $date){

        $carbonDate = Carbon::now();

        $employee = Employee::find($employeeID);

        $irregSchedule = IrregEmployeeSchedule::with(['schedule'])->where('employee_id', $employeeID)
            ->whereRaw('EXTRACT(MONTH FROM date) = ?', [$carbonDate->month])
            ->whereRaw('EXTRACT(YEAR FROM date) = ?', [$carbonDate->year])
            ->first();

        $scheduleID =  isset($irregSchedule) 
            ?  $irregSchedule->schedule->id 
            :  Schedule::where('default', true)->pluck('id')->first();
    
        if(!isset($scheduleID)){
            throw new Exception('No schedule found');
        }

        $this->irregularSchedule($employeeID, $employee->employee_number, $scheduleID, $date);
    }

    private function irregularSchedule($employeeID, $employeeNumber, $scheduleID, $date){

        $currentDate = new Carbon($date);
        $currentWeekNumber = $currentDate->weekOfMonth();
        $dayName = $currentDate->toDate()->format('D');

        $scheduleList = ScheduleList::with(['shifts'])
            ->where('week_number',$currentWeekNumber)
            ->where('schedule_id', $scheduleID)
            ->first();

        if(!isset($scheduleList)){
            throw new Exception('No Schedule List');
        }
        
        $shift = $scheduleList->getCurrentShift($dayName);

        if(isset($shift)){

            $isNextDay = $this->timeFormat($shift->start_time)->gte($shift->end_time);

            $this->generateEOM(
                    $employeeID,
                    $employeeNumber,
                    $date,
                    $isNextDay ? new Carbon($date)->addDay()->toDate()->format('Y-m-d') : $date,
                    $shift->start_time,
                    $shift->end_time,
            );
        }
    }

    private function regularSchedule($employeeID, $date){

        // $totalUnpaidBreaks = 0;
        
        // $unpaidBreaks = [
        //     [
        //         'start' => '12:00:00',
        //         'end' => '13:00:00',
        //     ],
        //     [
        //         'start' => '15:00:00',
        //         'end' => '16:00:00',
        //     ]
        // ];

        // $timeIN = DTR::where('type', 'IN')    
        //     ->where('employee_id', $employeeID)
        //     ->where('date', $date)
        //     ->min('time');

        // $timeOUT = DTR::where('type', 'OUT')    
        //     ->where('employee_id', $employeeID)
        //     ->where('date', $date)
        //     ->max('time');

        // $totalMinutes = isset($timeIN, $timeOUT)
        //     ? $this->timeFormat($timeIN)->diffInMinutes($this->timeFormat($timeOUT), true)
        //     : 0;

        // $regularMinutes = isset($timeIN, $timeOUT)
        //     ? $this->minTime($timeIN)
        //         ->diffInMinutes($this->maxTime($timeOUT))
        //     : 0;


        // foreach ($unpaidBreaks as $unpaidBreak) {
        //     if(isset($timeIN, $timeOUT)){
        //         $totalUnpaidBreaks += $this->minTime($timeIN, $unpaidBreak['start'])
        //             ->diffInMinutes($this->maxTime($timeOUT,  $unpaidBreak['end']), true);
        //     }
        // }

        // $underTime = isset($timeIN, $timeOUT)
        //     ? $this->timeFormat('08:00:00')
        //         ->diffInMinutes($this->timeFormat($timeIN), true)
        //     : 0;

        // $overTime = isset($timeIN, $timeOUT)
        //     ? $this->minTime($timeIN,'17:20:00')
        //         ->diffInMinutes($this->timeFormat($timeOUT), true)
        //     : 0;

        // EOM::updateOrCreate(
        //     ['employee_id' => $employeeID, 'date' => $date],
        //     [
        //         'time_in'  => $timeIN,
        //         'time_out'  => $timeOUT,
        //         'total_minutes'  => floor($totalMinutes),
        //         'regular_minutes'  => floor($regularMinutes - $totalUnpaidBreaks),
        //         'under_time_minutes' => $underTime,
        //         'overtime_minutes' => $overTime,
        //         'leave_credit' => 0,
        //         'shift_start'  => null,
        //         'shift_end'  => null,
        //         'date_in'  => $date,
        //         'date_out'  => $date,
        //     ],
        // );
    }

    private function generateEOM($employeeID, $employeeNumber, $dateIN, $dateOut, $shiftStart, $shiftEnd){

        $totalUnpaidBreaks = 0;
        
        $unpaidBreaks = [
            [
                'start' => '12:00:00',
                'end' => '13:00:00',
            ],
        ];

        $timeIN = DTR::where('type', 'IN')    
            ->where('employee_number', $employeeNumber)
            ->where('date', $dateIN)
            ->orderBy('time', 'asc')
            ->first();

        $timeOUT = DTR::where('type', 'OUT')    
            ->where('employee_number', $employeeNumber)
            ->where('date', $dateOut)
            ->orderBy('time', 'desc')
            ->first();

        $totalMinutes = isset($timeIN, $timeOUT)
            ? $this->toDate($timeIN)
                ->diffInMinutes($this->toDate($timeOUT))
            : 0;

        $regularMinutes =  isset($timeIN, $timeOUT) ?  $this->computeRegular($timeIN->toDate,$timeOUT->toDate,$shiftStart, $shiftEnd) : 0;

        foreach ($unpaidBreaks as $unpaidBreak) {
            if(isset($timeIN, $timeOUT)){

                $intervals = CarbonPeriod::create(
                    $this->minTime($timeIN, $shiftStart),
                    '1 minute',
                    $this->maxTime($timeOUT, $shiftEnd)
                )->excludeStartDate();

                foreach ($intervals as $interval) {

                    $breakTimeStart = $interval->copy()->setTimeFrom($unpaidBreak['start']); 
                    $breakTimeEnd = $interval->copy()->setTimeFrom($unpaidBreak['end']); 
                    
                    if($interval->between($breakTimeStart, $breakTimeEnd)){
                        $totalUnpaidBreaks += 1;
                    }
                }
            }
        }

        $late = isset($timeIN, $timeOUT) ?  $this->computeLate($timeIN->toDate,$shiftStart) : 0;
        $underTime = isset($timeIN, $timeOUT) ?  $this->computeUndertime($timeOUT->toDate,$shiftStart, $shiftEnd) : 0;
        $overTime = isset($timeIN, $timeOUT) ?  $this->computeOvertime($timeOUT->toDate,$shiftStart, $shiftEnd) : 0;

        EOM::updateOrCreate(
            ['employee_id' => $employeeID, 'date' => $dateIN],
            [
                'time_in'  => $timeIN?->time,
                'time_out'  => $timeOUT?->time,
                'total_minutes'  => floor($totalMinutes),
                'regular_minutes'  => floor($regularMinutes - $totalUnpaidBreaks),
                'under_time_minutes' => $underTime,
                'overtime_minutes' => $overTime,
                'late_minutes' => $late,
                'approved_overtime' => 0,
                'leave_credit' => 0,
                'shift_start'  => $shiftStart,
                'shift_end'  => $shiftEnd,
                'date_in'  => $timeIN?->date,
                'date_out'  => $timeOUT?->date,
            ],
        );
    }

    private function minTime($date, $min){

        $currentDate =  $this->toDate($date);
        $minTime =  $this->toDate($date)->setTimeFrom($min);

        return $currentDate->isBefore($minTime)
            ? $minTime
            : $currentDate;
    }

    private function maxTime($date, $max){

        $currentDate =  $this->toDate($date);
        $maxTime =  $this->toDate($date)->setTimeFrom($max);
        
        return $currentDate->isAfter($maxTime) 
            ? $maxTime
            : $currentDate;
    }

    private function timeFormat($time){
        return Carbon::createFromFormat('H:i:s', $time);
    }

    private function toDate($shift){
        return new Carbon($shift->date)->setTimeFrom($shift->time);
    }

    private function computeOvertime($timeOUT, $shiftStart, $shiftEND){
        
        $carbonTimeOUT = new Carbon($timeOUT);
        $carbonShiftEnd = new Carbon($shiftEND);
        $carbonShiftStart = new Carbon($shiftStart);

        if($carbonShiftStart->gte($carbonShiftEnd) && $carbonShiftStart->isSameDay($carbonShiftEnd)){
            $carbonShiftEnd->addDay();
        }

        $overTime = $carbonShiftEnd->diffInMinutes($carbonTimeOUT);
        
        return $overTime > 0 ? $overTime : 0;
    }

    private function computeLate($timeIN, $shiftStart){
        
        $carbonTimeIN = new Carbon($timeIN);
        $carbonShiftStart =   $carbonTimeIN->copy()->setTimeFrom($shiftStart);

        $late = $carbonShiftStart->diffInMinutes($carbonTimeIN);
       
        return $late > 0 ? $late : 0;
    }

    private function computeUndertime($timeOUT, $shiftStart, $shiftEND){
        
        $carbonTimeOUT = new Carbon($timeOUT);
        $carbonShiftEnd = new Carbon($shiftEND);
        $carbonShiftStart = new Carbon($shiftStart);

        if($carbonShiftStart->gte($carbonShiftEnd) && $carbonShiftStart->isSameDay($carbonShiftEnd)){
            $carbonShiftEnd->addDay();
        }

        $overTime = $carbonTimeOUT->diffInMinutes($carbonShiftEnd);
        
        return $overTime > 0 ? $overTime : 0;
    }

    private function computeRegular($timeIN, $timeOUT, $shiftStart, $shiftEND){
        
        $carbonTimeIn = new Carbon($timeIN);
        $carbonTimeOUT = new Carbon($timeOUT);

        $carbonShiftEnd = new Carbon($shiftEND);
        $carbonShiftStart = new Carbon($shiftStart);

        if($carbonShiftStart->gte($carbonShiftEnd) && $carbonShiftStart->isSameDay($carbonShiftEnd)){
            $carbonShiftEnd->addDay();
        }

        if($carbonTimeIn->lt($carbonShiftStart)){
            $carbonTimeIn = $carbonShiftStart->copy();
        }

        if($carbonTimeOUT->gt($carbonShiftEnd)){
            $carbonTimeOUT = $carbonShiftEnd->copy();
        }

        return $carbonTimeIn->diffInMinutes($carbonTimeOUT, true);
    }

}