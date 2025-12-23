<?php

namespace App\Actions;

use Carbon\Carbon;

class GenerateEOM
{
    
    public function run($date){

        if(!$date){
            $date = Carbon::now()->toDate();
        }

        
        
    }
}
