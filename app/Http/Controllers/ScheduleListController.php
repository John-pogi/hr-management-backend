<?php

namespace App\Http\Controllers;

use App\Models\ScheduleList;
use App\Http\Requests\StoreScheduleListRequest;
use App\Http\Requests\UpdateScheduleListRequest;
use App\Http\Resources\ScheduleListResource;
use App\Http\Resources\ScheduleListCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): ScheduleListCollection
    {
        $scheduleLists = ScheduleList::with(['schedule', 'shifts'])->paginate(20);
        
        return new ScheduleListCollection($scheduleLists);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleListRequest $request): JsonResponse
    {
        $scheduleList = ScheduleList::create($request->validated());
        $scheduleList->load(['schedule', 'shifts']);
        
        return (new ScheduleListResource($scheduleList))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ScheduleList $scheduleList): ScheduleListResource
    {
        $scheduleList->load(['schedule', 'shifts']);
        
        return new ScheduleListResource($scheduleList);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleListRequest $request, ScheduleList $scheduleList): JsonResponse
    {
        $scheduleList->update($request->validated());
        $scheduleList->load(['schedule', 'shifts']);
        
        return (new ScheduleListResource($scheduleList))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScheduleList $scheduleList): JsonResponse
    {
        $scheduleList->delete();
        
        return response()->json(null, 204);
    }
}
