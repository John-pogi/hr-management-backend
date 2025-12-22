<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyEmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DtrController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EomController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\IrregEmployeeScheduleController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveCodeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UserController;

Route::apiResource('companies',                CompanyController::class);
Route::apiResource('companies.employees', CompanyEmployeeController::class)
->only(['index']);

Route::apiResource('departments',              DepartmentController::class);
Route::apiResource('dtrs',                     DtrController::class);
Route::apiResource('employees',                EmployeeController::class);
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

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
