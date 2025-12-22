<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DTR extends Model
{
    /** @use HasFactory<\Database\Factories\DTRFactory> */
    use HasFactory;

    protected $table = 'dtr';

     protected $fillable = [
        'employee_id',
        'date',
        'time',
        'type',
    ]; 

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i:s',
    ];
}
