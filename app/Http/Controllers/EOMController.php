<?php

namespace App\Http\Controllers;

use App\Models\EOM;
use App\Http\Requests\StoreEOMRequest;
use App\Http\Requests\UpdateEOMRequest;
use App\Http\Resources\EOMResource;

class EOMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EOMResource::collection(EOM::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create EOM form']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEOMRequest $request)
    {
        $eom = EOM::create($request->validated());
        return new EOMResource($eom);
    }

    /**
     * Display the specified resource.
     */
    public function show(EOM $eOM)
    {
        return new EOMResource($eOM);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EOM $eOM)
    {
        return new EOMResource($eOM);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEOMRequest $request, EOM $eOM)
    {
        $eOM->update($request->validated());
        return new EOMResource($eOM);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EOM $eOM)
    {
        $eOM->delete();
        return response()->json(['message' => 'EOM record deleted successfully']);
    }
}
