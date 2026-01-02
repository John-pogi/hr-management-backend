<?php

namespace App\Utils;

use Carbon\Carbon;

class DayNameParser 
{
    private static $keys = [
        'SUN' => Carbon::SUNDAY,
        'MON' => Carbon::MONDAY,
        'TUE' => Carbon::TUESDAY,
        'WED' => Carbon::WEDNESDAY,
        'THU' => Carbon::THURSDAY,
        'FRI' => Carbon::FRIDAY,
        'SAT' => Carbon::SATURDAY,
    ];

    public static function parse(string $dayName)
    {
        $normalizeDayName = strtoupper($dayName);
        $normalizeDayName = trim($normalizeDayName);
        $normalizeDayName = substr($normalizeDayName, 0 ,3);

        if(!array_key_exists($normalizeDayName, DayNameParser::$keys)){
            return null;
        }
        
        return DayNameParser::$keys[$normalizeDayName];
    }

    public static function parseArray(array $days)
    {
        return array_map(function ($dayName) {
            return DayNameParser::parse($dayName);
        },$days);

    }
}
