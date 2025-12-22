<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveCode extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveCodeFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'valid_start',
        'valid_end',
    ];

    protected $casts = [
        'valid_start' => 'date',
        'valid_end'   => 'date',
    ];
}
