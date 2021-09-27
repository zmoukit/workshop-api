<?php

namespace App\Models;

use App\Models\Appointment;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;


class Car extends Model
{
    //
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
