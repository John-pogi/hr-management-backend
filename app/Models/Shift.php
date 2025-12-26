<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    /** @use HasFactory<\Database\Factories\ShiftFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'start_time',
        'end_time',
        'day_of_week',
        'flag',
    ];

    protected $casts = [
        'day_of_week' => 'array',
        'flag'        => 'boolean',
    ];
}
