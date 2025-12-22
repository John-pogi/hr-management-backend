<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
 
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return Department::paginate(20);
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
    public function store(StoreDepartmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $deparment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $deparment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $deparment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $deparment)
    {
        //
    }   //
}
