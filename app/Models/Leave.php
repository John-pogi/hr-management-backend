<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveFactory> */
    use HasFactory;

     protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'is_approved',
        'approved_by',
        'leave_type_id',
        'approved_date',
        'notes',
        'leave_code_id',
    ];

    protected $casts = [
        'is_approved'   => 'boolean',
        'start_date'    => 'date',
        'end_date'      => 'date',
        'approved_date' => 'datetime',
    ];
}
