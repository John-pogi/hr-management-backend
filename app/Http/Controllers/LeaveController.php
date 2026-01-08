<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Http\Resources\LeaveResource;
use App\Models\Leave;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $leaves = Leave::with([
                'leaveType', 
                'employee',
                'employee.company',
                'employee.deparment', 
                'employee.leaves',
                'employee.sickLeaves',
                'employee.vacationLeaves',
            ])->paginate(20);

        return LeaveResource::collection($leaves);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create Leave form']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequest $request)
    {

        $leave = Leave::create($request->validated());

        return new LeaveResource($leave);
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        return new LeaveResource($leave);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        return new LeaveResource($leave);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        $leave->update($request->validated());

        return new LeaveResource($leave);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();

        return response()->json(['message' => 'Leave deleted successfully']);
    }
}
