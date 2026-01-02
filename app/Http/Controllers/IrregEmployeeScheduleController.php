<?php

namespace App\Http\Controllers;

use App\Models\IrregEmployeeSchedule;
use App\Http\Requests\StoreIrregEmployeeScheduleRequest;
use App\Http\Requests\UpdateIrregEmployeeScheduleRequest;
use App\Http\Resources\IrregEmployeeScheduleResource;
use Exception;
use Illuminate\Http\Request;

class IrregEmployeeScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return IrregEmployeeScheduleResource::collection(IrregEmployeeSchedule::paginate($request->per_page));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create Irregular Employee Schedule form']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIrregEmployeeScheduleRequest $request)
    {
        try{
            $irregEmployeeSchedule = IrregEmployeeSchedule::create($request->validated());
            return new IrregEmployeeScheduleResource($irregEmployeeSchedule);
        }catch(Exception $err){
            return response()->json(['message' => 'Something went'], 500);
        }
     
    }

    /**
     * Display the specified resource.
     */
    public function show(IrregEmployeeSchedule $irregEmployeeSchedule)
    {
        return new IrregEmployeeScheduleResource($irregEmployeeSchedule);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IrregEmployeeSchedule $irregEmployeeSchedule)
    {
        return new IrregEmployeeScheduleResource($irregEmployeeSchedule);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIrregEmployeeScheduleRequest $request, IrregEmployeeSchedule $irregEmployeeSchedule)
    {
        $irregEmployeeSchedule->update($request->validated());
        return new IrregEmployeeScheduleResource($irregEmployeeSchedule);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IrregEmployeeSchedule $irregEmployeeSchedule)
    {
        $irregEmployeeSchedule->delete();
        return response()->json(['message' => 'Irregular Employee Schedule deleted successfully']);
    }
}
