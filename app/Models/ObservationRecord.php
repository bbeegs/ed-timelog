<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ObservationRecord extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getHourlyTotals(){
        $total_time  = DB::table('observation_records')->get('total_hours');
        $total_hours = 0;
        $total_mins = 0;
        foreach($total_time as $th){
            list($hour, $minute) = explode(':', $th->total_hours);
            $total_mins += $hour * 60;
            $total_mins += $minute;
        }
        $total_hours = floor($total_mins / 60);
        $total_mins -= $total_hours * 60;
        return sprintf('%02d:%02d', $total_hours, $total_mins);
    }
}
