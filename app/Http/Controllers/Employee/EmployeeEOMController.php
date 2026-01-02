<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EOM;
use Illuminate\Http\Request;

class EmployeeEOMController extends Controller
{
     public function index(Request $request, Employee $employee){
      
        $date = $request->input('date');

        return EOM::when($date, function($qb)use($date){
                $qb->where('date',$date);
        })
            ->where('employee_id',$employee->id)
             ->paginate($request->per_page);
    }
}
