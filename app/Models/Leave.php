<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    /** @use HasFactory<\Database\Factories\LeaveFactory> */
    use HasFactory;

     protected $fillable = [
        'employee_id',
        'start_date',
        'end_date',
        'leave_type_id',
        'notes',
        'leave_code_id',
        'valid_credit',
        'modified_by',
        'modified_date',
        'status',
    ];

    protected $casts = [
        'start_date'    => 'date',
        'end_date'      => 'date',
        'modified_date' => 'datetime',
    ];

    public function employee(): BelongsTo{
        return $this->belongsTo(Employee::class);
    }
}
