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
        $total_hours  = DB::table('observation_records')->get('total_hours');
        $total_time = 0;
        foreach($total_hours as $th){
            $total_time += strtotime($th->total_hours);
        }
        return date('h:i', $total_time);
    }
}
