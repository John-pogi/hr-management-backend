<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departmentable extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentableFactory> */
    use HasFactory;

    protected $fillable = [
        'deparment_id',
        'company_id',
    ]; 

}
