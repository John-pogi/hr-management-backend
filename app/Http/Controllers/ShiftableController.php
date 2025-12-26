<?php

namespace App\Http\Controllers;

use App\Models\ScheduleListable;
use App\Http\Requests\StoreScheduleListableRequest;
use App\Http\Requests\UpdateScheduleListableRequest;
use App\Models\Shiftables;

class ShiftableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreScheduleListableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Shiftables $shiftable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shiftables $shiftable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateScheduleListableRequest $request, Shiftables $shiftable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shiftables $shiftable)
    {
        //
    }
}
