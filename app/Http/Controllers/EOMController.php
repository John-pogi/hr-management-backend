<?php

namespace App\Http\Controllers;

use App\Models\EOM;
use App\Http\Requests\StoreEOMRequest;
use App\Http\Requests\UpdateEOMRequest;
use App\Http\Resources\EOMResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class EOMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        
        $status = $request->input('status');
        $companyID = $request->input('company_id');
        $departmentID = $request->input('department_id');
        $search = $request->input('search');
        $from = $request->input('from');
        $to = $request->input('to');
        $status = $request->input('status');

        $eoms = EOM::with(['employee','employee.company','employee.deparment'])
        
         ->when($companyID, function($qb) use($companyID){
                $qb->whereHas('employee.company', function($qb) use($companyID){
                    $qb->where('id',$companyID);
                });
            })
             ->when($status, function($qb) use($status){

                    switch($status){
                        case 'absent':
                            $qb->whereNull('time_in');
                            $qb->whereNull('time_out');
                            break;
                        case 'partial':
                            $qb->where(function($qb){
                                $qb->whereNull('time_in');
                                $qb->whereNotNull('time_out');
                            })->orWhere(function($qb){
                                $qb->whereNotNull('time_in');
                                $qb->whereNull('time_out');
                            });
                            break;
                        case 'present':
                                 $qb->whereNotNull('time_in');
                                 $qb->whereNotNull('time_out');
                        break;
                    }
            })
            ->when($from, function($qb) use($from){
                 $qb->where('date', '>=', $from);
            })
            ->when($to, function($qb) use($to){
                 $qb->where('date', '<=', $to);
            })
             ->when($departmentID, function($qb) use($departmentID){
                 $qb->whereHas('employee.deparment', function($qb) use($departmentID){
                        $qb->where('id',$departmentID);
                 });
            })
              ->when($search, function($qb) use($search){
                  $qb->whereHas('employee', function($qb) use($search){
                    $qb->whereLike('fullname', '%'. $search.'%');
                    $qb->orWhereLike('employee_number', '%'.$search.'%');
                 });
            })
        ->paginate($request->per_page);

        return EOMResource::collection($eoms);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->json(['message' => 'Create EOM form']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEOMRequest $request)
    {
        $eom = EOM::create($request->validated());
        return new EOMResource($eom);
    }

    /**
     * Display the specified resource.
     */
    public function show(EOM $eOM)
    {

        $response = Gate::inspect('view',$eOM);

        dd( $response);

        if(!$response->allowed()){
            return 'Oh no!';
        }

        return new EOMResource($eOM);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EOM $eOM)
    {
        return new EOMResource($eOM);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEOMRequest $request, EOM $eOM)
    {
        $eOM->update($request->validated());
        return new EOMResource($eOM);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EOM $eOM)
    {
        $eOM->delete();
        return response()->json(['message' => 'EOM record deleted successfully']);
    }
}
