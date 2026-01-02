<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\DTR;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeDTRController extends Controller
{
  
    public function index(Request $request, Employee $employee){
      
        $date = $request->input('date');
        $type = $request->input('type');

        return DTR::when($date, function($qb)use($date){
                $qb->where('date',$date);
        })
            ->when($type, function($qb)use($type){
                    $qb->where('type',$type);
            })
            ->where('employee_id',$employee->id)
            ->paginate($request->per_page);
    }

}
