<?php

namespace App\Http\Controllers;

use App\Models\LeaveCode;
use App\Http\Requests\StoreLeaveCodeRequest;
use App\Http\Requests\UpdateLeaveCodeRequest;
use App\Http\Resources\LeaveCodeResource;
use Illuminate\Http\Request;

class LeaveCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return LeaveCodeResource::collection(LeaveCode::paginate($request->per_page));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create Leave Code form']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveCodeRequest $request)
    {
        $leaveCode = LeaveCode::create($request->validated());
        return new LeaveCodeResource($leaveCode);
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveCode $leaveCode)
    {
        return new LeaveCodeResource($leaveCode);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveCode $leaveCode)
    {
        return new LeaveCodeResource($leaveCode);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveCodeRequest $request, LeaveCode $leaveCode)
    {
        $leaveCode->update($request->validated());
        return new LeaveCodeResource($leaveCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LeaveCode $leaveCode)
    {
        $leaveCode->delete();
        return response()->json(['message' => 'Leave Code deleted successfully']);
    }
}
