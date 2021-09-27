<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'car_id' => ['required', 'numeric', 'gte:1', 'exists:cars,id'],
            'workshop_id' => ['required', 'numeric', 'gte:1', 'exists:workshops,id'],
            'start_time' => ['required', 'date_format:dd-mm-Y'],
            'end_time' => ['required', 'date_format:dd-mm-Y', 'gt:start_time']
        ];
    }

    public function attributes()
    {
        return [
            'car_id' => 'Car ID',
            'workshop_id' => 'Workshop ID',
            'start_time' => 'Start time',
            'end_time' => 'End Time'
        ];
    }
}
