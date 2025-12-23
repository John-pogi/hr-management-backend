<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Leave;
use Illuminate\Http\Request;

class EmployeeLeaveController extends Controller
{
     public function index(Request $request, Employee $employee){

        $date = $request->input('date');
        $status = $request->input('status');
        $type = $request->input('type');


        return Leave::where('employee_id',$employee->id)
            ->when($date, function($qb)use($date){
                $qb->where('date',$date);
            })
             ->when($status, function($qb)use($status){
                $qb->where('status',$status);
            })
             ->when($type, function($qb)use($type){
                $qb->where('leave_type_id',$type);
            })
            ->paginate(20);
    }
}
