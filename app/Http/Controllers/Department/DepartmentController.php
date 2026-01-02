<?php

namespace App\Http\Controllers\Department;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
 
    public function index(Request $request){
        return Department::paginate($request->per_page);
    }

    public function store(StoreDepartmentRequest $request){
        $department = Department::create($request->validated());
        return response()->json($department, 201);
    }

   
    public function show(Department $department){
        return response()->json($department);
    }

    public function update(UpdateDepartmentRequest $request, Department $department){
        $department->update($request->validated());
        return response()->json($department);
    }

   
    public function destroy(Department $department){
        $department->delete();
        return response()->json(null, 204);
    }

}
