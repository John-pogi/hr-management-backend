<?php

namespace App\Http\Controllers;

use App\Models\DTR;
use App\Http\Requests\StoreDTRRequest;
use App\Http\Requests\UpdateDTRRequest;
use Illuminate\Http\Request;

class DTRController extends Controller
{
   
    public function index(Request $request)
    {
        return DTR::paginate($request->per_page);
    }

    public function store(StoreDTRRequest $request){
        $dtr = DTR::create($request->validated());
        return response()->json($dtr, 201);
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