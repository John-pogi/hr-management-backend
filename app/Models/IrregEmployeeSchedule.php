<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IrregEmployeeSchedule extends Model
{
    /** @use HasFactory<\Database\Factories\IrregEmployeeScheduleFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'employee_id',
        'shift_id',
        'week_number',
    ];

    protected $casts = [
        'date'        => 'date',
        'week_number' => 'integer',
    ];
}
