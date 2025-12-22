<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

     protected $fillable = [
        'fullname',
        'email',
        'department',
        'company',
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
}
