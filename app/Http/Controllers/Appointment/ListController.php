<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Services\AppointmentService;
use App\Http\Resources\AppointmentResource;

class ListController extends Controller
{
    protected $appointmentService;

    public function __construct(
        AppointmentService $appointmentService
    ) {
        $this->appointmentService = $appointmentService;
    }

    public function list(Request $request)
    {
        try {
            $aData = $request->all();

            //************ Check if the request has only one param  **********************/
            if (is_array($aData) && count($aData) > 1) {
                return response()->json([
                    'status' => 'ERROR',
                    'message' => $this->incorrectNumberOfParams
                ], 500);
            }

            //******************************* Validation **********************/
            $validator = $this->validator($aData);
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();

                return response()->json([
                    'status' => 'ERROR',
                    'message' => $errors
                ], 500);
            }

            /**
             * If the request has workshop_id so we add it to filter
             */
            $aWhere = [];
            if ($request->filled('workshop_id')) {
                $aWhere['workshop_id'] = $aData['workshop_id'];
            }

            $aListAppointment = $this->appointmentService->getAll($aWhere);

            /**
             * I decided to use Resource to controlle columns
             * We will put on response because there are some 
             * columns we don't want to send them to the end user
             */
            $aListAppointment = AppointmentResource::collection($aListAppointment);

            return response()->json([
                'status' => 'SUCCESS',
                'appointments' => $aListAppointment
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'ERROR',
                'message' => $this->internalError
            ], 500);
        }
    }

    private function validator($aData)
    {
        return Validator::make(
            $aData,
            [
                'workshop_id' => ['nullable', 'numeric', 'gte:1', 'exists:workshops,id'],
            ],
            [],
            [
                'workshop_id' => 'Workshop Id',
            ]
        );
    }
}
