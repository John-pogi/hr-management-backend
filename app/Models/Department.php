<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DeparmentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
