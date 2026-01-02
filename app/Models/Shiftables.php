<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shiftables extends Model
{
    /** @use HasFactory<\Database\Factories\ScheduleListableFactory> */
    use HasFactory;

    protected $fillable = [
        'shift_id',
        'schedule_list_id',
    ];
    
}
