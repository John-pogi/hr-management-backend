<?php

namespace App\Http\Controllers;

use App\Models\Departmentable;
use App\Http\Requests\StoreDepartmentableRequest;
use App\Http\Requests\UpdateDepartmentableRequest;
use Illuminate\Http\Request;

class DepartmentableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
    public function store(StoreDepartmentableRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Departmentable $departmentable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departmentable $departmentable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentableRequest $request, Departmentable $departmentable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departmentable $departmentable)
    {
        //
    }
}
