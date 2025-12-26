<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Http\Resources\ScheduleResource;
use Illuminate\Http\JsonResponse;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        
        $schedules = Schedule::paginate(20);
        
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
        $schedule = Schedule::create($request->validated());
        $schedule->load('supervisor');
        
        return response()->json($schedule, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule): JsonResponse
    {
        $schedule->load('supervisor');
        
        return response()->json($schedule);
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
        $schedule->update($request->validated());
        $schedule->load('supervisor');
        
        return response()->json($schedule);
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