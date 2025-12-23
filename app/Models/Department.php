<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DeparmentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function companies(): BelongsToMany{
        return $this->belongsToMany(Company::class, 'departmentables', 'department_id', 'company_id');
    }
}
