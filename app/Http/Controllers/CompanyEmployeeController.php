<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{

    
    public function index(Request $request, Company $company)
    {
        return Employee::when($request->input('dertparment'), function($qb) use($request){
            $qb->where('derparment_id',$request->input('dertparment'));
        })
        ->where('company_id', $company->id)
        ->paginate(20);
    }

}
