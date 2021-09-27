<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'workshop_id' => $this->workshop_id,
            'appointment_id' => $this->id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            /*'car_id' => $this->car_id,
            'car_brand' => $this->make,*/
            //'car_model' => $this->model,
            //'workshop_name' => $this->name
        ];
    }
}
