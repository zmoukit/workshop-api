<?php

namespace App\Services;

use App\Models\Appointment;

class AppointmentService extends BaseService
{
  public $model;

  public function __construct(
    Appointment $appointmentModel
  ) {
    $this->model = $appointmentModel;
  }

  public function getAll($aWhere = array())
  {
    return $this->model->getAll($aWhere);
  }

  public function checkWorkshopAvailability($workshopId, $from, $to)
  {
    return $this->model->checkWorkshopAvailability($workshopId, $from, $to);
  }

  public function saveAppointment($aData)
  {
    $aAppointment = $this->_toArray($aData);
    return $this->create($aAppointment);
  }
}
