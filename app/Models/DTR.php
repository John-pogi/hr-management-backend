<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function employee():BelongsTo{
        return $this->belongsTo(Employee::class);
    }
    
    public function getToDateAttribute()
    {
        if (!$this->date || !$this->time) {
            return null;
        }
        
        return \Carbon\Carbon::parse($this->date)
            ->setTimeFromTimeString($this->time)
            ->format('Y-m-d H:i:s');
    }
    
 
}
