<?php

namespace App\Models;

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
        'company_id'
    ];

    public function dtr(): HasMany{
        return $this->hasMany(DTR::class);
    }

    public function leaves(): HasMany{
        return $this->hasMany(Leave::class);
    }

    public function deparment(): BelongsTo{
        return $this->belongsTo(Department::class);
    }

    public function company(): BelongsTo{
        return $this->belongsTo(Company::class);
    }

    public function supervisor(): HasOne{
        return $this->hasOne(Supervisor::class, 'department_id', 'department_id')
            ->whereColumn('company_id', 'supervisors.company_id')
            ->whereColumn('id', '!=','supervisors.employee_id');
    }

    public function ceoApproval(): HasOne{
        return $this->hasOne(Supervisor::class, 'employee_id','id');
    }

    public function usedLeaveCredits(){
        return $this->leaves->where('status','approved');
    }

}
