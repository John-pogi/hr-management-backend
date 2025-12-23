<?php

namespace App\Http\Controllers;

use App\Models\Supervisor;
use App\Http\Requests\StoreSupervisorRequest;
use App\Http\Requests\UpdateSupervisorRequest;
use App\Http\Resources\SupervisorResource;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SupervisorResource::collection(Supervisor::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create Supervisor form']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupervisorRequest $request)
    {
        $supervisor = Supervisor::create($request->validated());
        return new SupervisorResource($supervisor);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supervisor $supervisor)
    {
        return new SupervisorResource($supervisor);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supervisor $supervisor)
    {
        return new SupervisorResource($supervisor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupervisorRequest $request, Supervisor $supervisor)
    {
        $supervisor->update($request->validated());
        return new SupervisorResource($supervisor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supervisor $supervisor)
    {
        $supervisor->delete();
        return response()->json(['message' => 'Supervisor deleted successfully']);
    }
}
