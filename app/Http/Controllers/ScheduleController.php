<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Resources\ScheduleResource;
use App\Models\ScheduleList;
use App\Models\Shift;
use App\Models\Shiftables;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
       
        $schedules = Schedule::with(['list', 'list.shifts'])
            ->paginate($request->per_page);

        return ScheduleResource::collection($schedules);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // API endpoint - no form needed
        return response()->json([], 405);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleRequest $request): JsonResponse
    {
        $inputs = $request->validated();

        $schedule = Schedule::create(['title' => $inputs['title']]);

        $shifts = $inputs['shift'];

        foreach($shifts as $shift){

            $scheduleList = ScheduleList::create([
                'schedule_id' => $schedule->id,
                'week_number' => $shift['week']
            ]);

            $shift = Shift::firstOrCreate(
                [
                    'start_time' => $shift['start'],
                    'end_time' => $shift['end'],
                    'day_of_week' => implode(',',$shift['day_of_week']),
                ],
                [
                    'title' => '',
                    'flag' => false,
                ]
            );

            Shiftables::create([
                 'shift_id' => $shift->id,
                'schedule_list_id' => $scheduleList->id,
            ]);
        }

        return response()->json($schedule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        $schedule->load(['list','list.shifts']);
        
        return new ScheduleResource($schedule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        // API endpoint - no form needed
        return response()->json([], 405);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule): JsonResponse
    {

        
        $schedule->load(['list','list.shifts']);

        $inputs = $request->validated();

        $schedule->title =  $inputs['title'];

        $schedule->save();

        $shifts = $inputs['shift'];

        foreach ($schedule->list as $list) {
            Shiftables::where('schedule_list_id', $list->id)->delete();            
        }

        ScheduleList::where('schedule_id', $schedule->id)->delete();

        foreach($shifts as $shift){


            $scheduleList = ScheduleList::create([
                'schedule_id' => $schedule->id,
                'week_number' => $shift['week']
            ]);

            $shift = Shift::firstOrCreate(
                [
                    'start_time' => $shift['start'],
                    'end_time' => $shift['end'],
                    'day_of_week' => implode(',',$shift['day_of_week']),
                ],
                [
                    'title' => '',
                    'flag' => false,
                ]
            );

            Shiftables::create([
                'shift_id' => $shift->id,
                'schedule_list_id' => $scheduleList->id,
            ]);
        }

        return response()->json($schedule, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule): JsonResponse
    {
        $schedule->delete();
        
        return response()->json(null, 204);
    }
}