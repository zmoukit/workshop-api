<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkshopResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\WorkshopService;
use App\Services\AppointmentService;

class RecommendController extends Controller
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

    public function recommend(Request $request)
    {
        try {
            $aData = $request->all();
            //************ Check if the request has only one param  **********************/
            if (is_array($aData) && count($aData) != 2) {
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
             * get workingshops by working time
             */
            $from = date('H:i:00', strtotime($aData['start_time']));
            $to = date('H:i:00', strtotime($aData['end_time']));
            $aWorkshops = $this->workshopService->getWorkshopsByWorkingTime(
                $from,
                $to
            );

            /**
             * I decided to use Resource to controlle columns
             * We will put on response because there are some 
             * columns we don't want to send them to the end user
             */
            $aWorkshops = WorkshopResource::collection($aWorkshops);

            $aListWorkshops = [];
            if ($aWorkshops->count() > 0) {
                $fromDateTime = date('Y-m-d H:i:00', strtotime($aData['start_time']));
                $toDateTime = date('Y-m-d H:i:00', strtotime($aData['end_time']));

                foreach ($aWorkshops as $aWorkshop) {
                    $isTheWorkshopAvailable = $this->appointmentService->checkWorkshopAvailability(
                        $aWorkshop->id,
                        $fromDateTime,
                        $toDateTime
                    );

                    if (!$isTheWorkshopAvailable) {
                        continue;
                    }

                    $aListWorkshops[] = $aWorkshop;
                }
            }

            return response()->json([
                'status' => 'SUCCESS',
                'workshops' => $aListWorkshops
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
                'start_time' => ['required', 'date_format:d-m-Y H:i'],
                'end_time' => ['required', 'date_format:d-m-Y H:i', 'after:start_time']
            ],
            [],
            [
                'start_time' => 'Start time',
                'end_time' => 'End Time'
            ]
        );
    }
}
