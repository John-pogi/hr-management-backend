<?php

use App\Actions\GenerateEOM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Companies\CompanyController;
use App\Http\Controllers\Companies\CompanyDeparment;
use App\Http\Controllers\Companies\CompanyEmployeeController;
use App\Http\Controllers\Department\DeparmentCompanyController;
use App\Http\Controllers\Department\DepartmentController;

use App\Http\Controllers\DtrController;

use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\EmployeeDTRController;
use App\Http\Controllers\Employee\EmployeeEOMController;
use App\Http\Controllers\Employee\EmployeeLeaveApprovalsController;
use App\Http\Controllers\Employee\EmployeeLeaveController;
use App\Http\Controllers\Employee\EmployeeScheduleController;
use App\Http\Controllers\EomController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\IrregEmployeeScheduleController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveCodeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ScheduleListController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;
use App\Models\EOM;
use Carbon\Carbon;

Route::apiResource('companies',                CompanyController::class);
Route::apiResource('companies.employees', CompanyEmployeeController::class)
    ->only(['index']);
Route::apiResource('companies.departments', CompanyDeparment::class)
    ->only(['index']);
    
Route::apiResource('departments',              DepartmentController::class);
Route::apiResource('departments.companies',   DeparmentCompanyController::class)
    ->only(['index','post']);
Route::patch('/departments/{deparment}/companies',   [DeparmentCompanyController::class, 'update']);

Route::apiResource('dtr',                     DtrController::class);

Route::apiResource('employees',                EmployeeController::class);

Route::apiResource('employees.dtr', EmployeeDTRController::class)
    ->only(['index']);

Route::apiResource('employees.eom', EmployeeEOMController::class)
    ->only(['index']);

Route::apiResource('employees.leaves', EmployeeLeaveController::class)
    ->only(['index']);

Route::apiResource('employees.approvals', EmployeeLeaveApprovalsController::class)
    ->only(['index']);

Route::apiResource('employees.schedules', EmployeeScheduleController::class)
    ->only(['index']);

    
Route::apiResource('eoms',                     EomController::class);
Route::apiResource('holidays',                 HolidayController::class);
Route::apiResource('irreg-employee-schedules', IrregEmployeeScheduleController::class);
Route::apiResource('leaves',                   LeaveController::class);
Route::apiResource('leave-codes',              LeaveCodeController::class);
Route::apiResource('leave-types',              LeaveTypeController::class);
Route::apiResource('roles',                    RoleController::class);
Route::apiResource('shifts',                   ShiftController::class);

Route::apiResource('supervisors',              SupervisorController::class);
Route::apiResource('uploads',                  UploadController::class);
Route::apiResource('users',                    UserController::class);

Route::apiResource('schedules',                  ScheduleController::class);
Route::apiResource('schedule-lists',                  ScheduleListController::class);

Route::get('/', function(){
    
    $eom = new GenerateEOM();
    $eom->run(1,Carbon::now()->toDate());

    return EOM::where('employee_id', 1)->get();
});

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
