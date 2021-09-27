<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'car_id', 'workshop_id', 'start_time',
        'end_time', 'created_at', 'updated_at'
    ];

    //
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }

    public function getAll($aWhere)
    {
        $query = DB::table('appointments')
            ->join('cars', 'cars.id', '=', 'car_id')
            ->join('workshops', 'workshops.id', '=', 'workshop_id');
        if (is_array($aWhere) && count($aWhere) > 0) {
            $query->where($aWhere);
        }

        return $query->get()->toArray();
    }

    public function checkWorkshopAvailability($workshopId, $from, $to)
    {
        $from = date('Y-m-d H:i:00', strtotime($from));
        $to = date('Y-m-d H:i:00', strtotime($to));

        $isTheWorkshopAvailable =  DB::table('appointments')
            ->join('workshops', 'workshops.id', '=', 'workshop_id')
            ->whereDate('start_time', date('Y-m-d', strtotime($from)))
            ->where('workshop_id', $workshopId)
            ->whereRaw('(
                (? between `start_time` AND `end_time`) 
                OR 
                (? between `start_time` AND `end_time`)
                oR 
                ( 
                    (start_time between ? AND ?) 
                    AND 
                    (end_time between ? AND ?)
                )
            )', [$from, $to, $from, $to, $from, $to])
            ->get()
            ->first();

        if ($isTheWorkshopAvailable !== null) {
            return false;
        }

        return true;
    }
}
