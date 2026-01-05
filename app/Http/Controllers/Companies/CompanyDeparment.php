<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyDepartmentStore;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class CompanyDeparment extends Controller
{
    
    public function index(Request $request, Company $company){
        return $company->deparments()->paginate($request->per_page);
    }

    public function store(CompanyDepartmentStore $request, Company $company){

        $departments = $request->validated()['deparments'];
        
        return response()->json(['message' => 'Companies updated'], 200);
    }

    
}
