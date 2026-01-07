<?php

namespace App\Http\Controllers;

use App\Models\DTR;
use App\Http\Requests\StoreDTRRequest;
use App\Http\Requests\UpdateDTRRequest;
use App\Http\Resources\DTRCollection;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DTRController extends Controller
{
   
    public function index(Request $request)
    {

        $status = $request->input('status');
        $companyID = $request->input('company_id');
        $departmentID = $request->input('department_id');
        $search = $request->input('search');
        $from = $request->input('from');
        $to = $request->input('to');

        $users = DB::table('employees')
            ->leftJoin('dtr', 'employees.id', '=', 'dtr.employee_id')
            ->leftJoin('companies', 'companies.id', '=', 'employees.company_id')
            ->leftJoin('departments', 'departments.id', '=', 'employees.department_id')
            ->select([
                'employees.fullname as employee_name',
                'employees.id as employee_id',
                'employees.employee_number',
                'companies.name as company_name',
                'companies.id as company_id',
                'departments.name as deparment_name',
                'departments.id as deparment_id',
                'dtr.date', 
                DB::raw("MIN(CASE WHEN dtr.type = 'IN' THEN dtr.time END) as time_in"),
                DB::raw("MAX(CASE WHEN dtr.type = 'OUT' THEN dtr.time END) as time_out")
            ])
            ->when($status, function($qb) use($status){
                    switch($status){
                        case 'absent':
                            $qb->havingRaw("
                                MIN(CASE WHEN dtr.type = 'IN' THEN dtr.time END) IS NULL and
                                MIN(CASE WHEN dtr.type = 'OUT' THEN dtr.time END) IS NULL
                            ");
                            break;
                        case 'partial':
                                $qb->havingRaw("
                                    MIN(CASE WHEN dtr.type = 'IN' THEN dtr.time END) IS NULL and
                                    MIN(CASE WHEN dtr.type = 'OUT' THEN dtr.time END) IS NOT NULL
                                ");

                                $qb->orHavingRaw("
                                    MIN(CASE WHEN dtr.type = 'IN' THEN dtr.time END) IS NOT NULL and
                                    MIN(CASE WHEN dtr.type = 'OUT' THEN dtr.time END) IS NULL
                                ");
                        case 'present':
                                $qb->havingRaw("
                                    MIN(CASE WHEN dtr.type = 'IN' THEN dtr.time END) IS NOT NULL and
                                    MIN(CASE WHEN dtr.type = 'OUT' THEN dtr.time END) IS NOT NULL
                                ");
                        break;
                    }
            })
            ->when($companyID, function($qb) use($companyID){
                 $qb->where('companies.id', $companyID);
            })
            ->when($from, function($qb) use($from){
                 $qb->where('dtr.date', '>=', $from);
            })
            ->when($to, function($qb) use($to){
                 $qb->where('dtr.date', '>=', $to);
            })
             ->when($departmentID, function($qb) use($departmentID){
                 $qb->where('departments.id', $departmentID);
            })
              ->when($search, function($qb) use($search){
                $qb->whereLike('employees.fullname', '%'. $search.'%', false, 'or');
                $qb->orWhereLike('employees.employee_number', '%'.$search.'%');
            })
            ->groupBy(['dtr.date','employees.id','companies.id','departments.id'])
            ->paginate();

        return $users;

        // $dtr = DTR::with(['employee','employee.company','employee.deparment'])
        //     ->when($request->input('date'), function($qb)use($request){
        //         $qb->where('date', $request->input('date'));
        //     })
        //     ->when($request->input('employee_id'), function($qb)use($request){
        //         $qb->where('employee_id', $request->input('employee_id'));
        //     })
        //     ->when($request->input('type'), function($qb)use($request){
        //         $qb->where('type', $request->input('type'));
        //     })
        //     ->paginate($request->per_page);

        // return new DTRCollection($dtr);
    }

    public function store(StoreDTRRequest $request){
        
        $dtrs = $request->validated()['dtr'];
        
        $createdTime = Carbon::now();

        $normalize = array_map(fn($item) => [...$item, 'created_at' => $createdTime, 'updated_at' => $createdTime], $dtrs);

        DTR::insert($normalize);

        return response()->json(['messages' => 'inserted'], 201);
    }

    public function show(DTR $dTR){
        return response()->json($dTR);
    }

    public function update(UpdateDTRRequest $request, DTR $dTR){
        $dTR->update($request->validated());
        return response()->json($dTR);
    }

    public function destroy(DTR $dTR)
    {
        $dTR->delete();
        return response()->json(null, 204);
    }
}