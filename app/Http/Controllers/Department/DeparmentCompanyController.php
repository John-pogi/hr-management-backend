<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentableRequest;
use App\Http\Requests\UpdateDepartmentableRequest;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class DeparmentCompanyController extends Controller
{

    public function index(Request $request, Department $department){
        return $department->companies()->paginate($request->per_page);
    }

    public function store(StoreDepartmentableRequest $request, Department $department)
    {

        $companyIds = collect($request->validated()['companies'])
            ->pluck('company_id')
            ->toArray();

        $department->companies()->attach($companyIds);

        return response()->json(['message' => 'Companies assigned'], 201);
    }

    public function update(UpdateDepartmentableRequest $request, Department $department){

        $attachCompanyIds = collect($request->validated()['companies'])
            ->pluck('company_id')
            ->toArray();

        $removedCompanyIds = collect($request->validated()['remove_companies'])
            ->pluck('company_id')
            ->toArray();

        $department->companies()->attach($attachCompanyIds);
        $department->companies()->detach($removedCompanyIds);

        return response()->json(['message' => 'Companies updated'], 200);
    }
}
