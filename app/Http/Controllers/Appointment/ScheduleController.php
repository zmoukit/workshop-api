<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Appointment\ScheduleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\AppointmentService;
use App\Services\WorkshopService;

class ScheduleController extends Controller
{
    protected $appointmentService;
    protected $workshopService;

    public function __construct(
        AppointmentService $appointmentService,
        WorkshopService $workshopService
    ) {
        $this->appointmentService = $appointmentService;
        $this->workshopService = $workshopService;
    }

    public function schedule(Request $request)
    {
        try {
            $aData = $request->all();
            //************ Check if the request has only one param  **********************/
            if (is_array($aData) && count($aData) != 4) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => $this->incorrectNumberOfParams
                ], 500);
            }

            http: //127.0.0.1:8000/api/v1/appointment/schedule

            //******************************* Validation **********************/
            $validator = $this->validator($aData);
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();

                return response()->json([
                    'status' => 'ERROR',
                    'message' => $errors
                ], 500);
            }

            $workshopId = $aData['workshop_id'];
            $appointmentStartTime = date('H:i:00', strtotime($aData['start_time']));
            $appointmentEndTime = date('H:i:00', strtotime($aData['end_time']));


            /**
             * Check if the selected range time is match the workshop working time
             */
            $isTheWorkshopOpened = $this->workshopService->checkWorkshopWorkingHours(
                $workshopId,
                $appointmentStartTime,
                $appointmentEndTime
            );
            if ($isTheWorkshopOpened === null) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'The selected time range does not match the workshop working time.'
                ], 200);
            }

            /**
             * check if the workshop is available
             */
            $from = date('Y-m-d H:i:00', strtotime($aData['start_time']));
            $to = date('Y-m-d H:i:00', strtotime($aData['end_time']));
            $isTheWorkshopAvailable = $this->appointmentService->checkWorkshopAvailability(
                $workshopId,
                $from,
                $to
            );

            if (!$isTheWorkshopAvailable) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => 'The workshop does not available on the selected time range.'
                ], 200);
            }

            /**
             * Save appointment
             */
            $aData['created_at'] = $this->appointmentService->getCurrentTime();
            $aData['start_time'] = $from;
            $aData['end_time'] = $to;
            $this->appointmentService->saveAppointment($aData);

            return response()->json([
                'status' => 'SUCCESS',
                'message' => "Appointment has been scheduled successfully."
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'ERROR',
                'message' => 'Oops, Something went wrong'
            ], 500);
        }
    }

    private function validator($aData)
    {
        return Validator::make(
            $aData,
            [
                'car_id' => ['required', 'numeric', 'gte:1', 'exists:cars,id'],
                'workshop_id' => ['required', 'numeric', 'gte:1', 'exists:workshops,id'],
                'start_time' => ['required', 'date_format:d-m-Y H:i'/*, 'after:2 hours'*/],
                'end_time' => ['required', 'date_format:d-m-Y H:i', 'after:start_time']
            ],
            [],
            [
                'car_id' => 'Car ID',
                'workshop_id' => 'Workshop ID',
                'start_time' => 'Start time',
                'end_time' => 'End Time'
            ]
        );
    }
}
