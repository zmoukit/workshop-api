<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
