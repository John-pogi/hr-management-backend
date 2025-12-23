<?php

namespace App\Http\Controllers\Companies;
use App\Http\Controllers\Controller;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{

    
    public function index(Request $request, Company $company)
    {
        return Employee::when($request->input('department'), function($qb) use($request){
            $qb->where('department_id',$request->input('department'));
        })
        ->where('company_id', $company->id)
        ->paginate(20);
    }

}
