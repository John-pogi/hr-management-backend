<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EOM extends Model
{
    /** @use HasFactory<\Database\Factories\EOMFactory> */
    use HasFactory;

    protected $table = 'eom';

    protected $fillable = [
        'employee_id',
        'date',
        'time_in',
        'time_out',
        'total_hours',
        'shift_start',
        'shift_end',
    ];

    protected $casts = [
        'date'        => 'date',
        'time_in'     => 'datetime:H:i:s',
        'time_out'    => 'datetime:H:i:s',
        'shift_start' => 'datetime:H:i:s',
        'shift_end'   => 'datetime:H:i:s',
        'total_hours' => 'decimal:2',
    ];
}
