<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Workshop extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'latitude', 'longitude',
        'opening_time', 'closing_time', 'created_at',
        'updated_at', 'deleted_at'
    ];

    //
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function getWorkshopsByWorkingTime($fromTime, $toTime)
    {
        return DB::table('workshops')
            ->where('opening_time', '<=', $fromTime)
            ->where('closing_time', '>=', $toTime)
            ->get()
            ->toArray();
    }

    public function checkWorkshopWorkingHours($workshopId, $fromTime, $toTime)
    {
        return DB::table('workshops')
            ->where('opening_time', '<=', $fromTime)
            ->where('closing_time', '>=', $toTime)
            ->where('id', $workshopId)
            ->get()
            ->first();
    }
}
