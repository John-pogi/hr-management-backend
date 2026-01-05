<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Leave;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreditController extends Controller
{
    public function index(Request $request){

        $currentDate = Carbon::now();

        $employees = Employee::with(['leaves' => function($qb) use($currentDate){
            $qb->where(DB::raw("TO_CHAR(start_date, 'YYYY')"), $currentDate->year);
        }])
        ->where('id', 25)
        ->paginate(20);

        return $employees;
    }
}
