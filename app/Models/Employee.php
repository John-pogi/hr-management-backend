<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use HasFactory;

     protected $fillable = [
        'fullname',
        'email',
        'position',
        'contact',
        'sss',
        'pagibig',
        'tin',
        'start_date',
        'hired_date',
        'employee_number',
        'basic_pay',
        'philhealth',
        'company_id',
        'department_id'
    ];

    public function dtr(): HasMany{
        return $this->hasMany(DTR::class, 'employee_number','employee_number');
    }

    public function leaves(): HasMany{
        return $this->hasMany(Leave::class);
    }

    public function deparment(): BelongsTo{
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function supervisor(){
        return $this->hasOne(Supervisor::class, 'department_id', 'department_id');
    }

    public function ceoApproval(): HasOne{
        return $this->hasOne(Supervisor::class, 'employee_id','id');
    }

    public function usedLeaveCredits(){
        return $this->leaves->where('status','approved');
    }

    public function sickLeaves(): HasMany{
        return $this->hasMany(Leave::class)
        ->whereHas('leaveType', fn($qb)=> $qb->where('type','sl'));
    }

    public function vacationLeaves(): HasMany{
        return $this->hasMany(Leave::class)
        ->whereHas('leaveType', fn($qb)=> $qb->where('type','vl'));
    }

    public function sickLeaveCredits(){
        
        $credit = 0.5 * Carbon::now()->month;

        $approvedSickLeaves = $this->sickLeaves->where('status','approved')->sum('valid_credit');

        return $credit - $approvedSickLeaves;
    }

    public function vacationLeaveCredits(){
        
        $credit = 0.5 * Carbon::now()->month;

        $approvedSickLeaves = $this->vacationLeaves->where('status','approved')->sum('valid_credit');

        return $credit - $approvedSickLeaves;
    }
    
}
