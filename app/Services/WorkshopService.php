<?php

namespace App\Services;

use App\Models\Workshop;

class WorkshopService extends BaseService
{
  public $model;

  public function __construct(
    Workshop $workshopModel
  ) {
    $this->model = $workshopModel;
  }

  public function getAll($aWhere = array())
  {
    return $this->model->getAll($aWhere);
  }

  public function getWorkshopsByWorkingTime($fromTime, $toTime)
  {
    return $this->model->getWorkshopsByWorkingTime($fromTime, $toTime);
  }

  public function checkWorkshopWorkingHours($workshopId, $fromTime, $toTime)
  {
    return $this->model->checkWorkshopWorkingHours($workshopId, $fromTime, $toTime);
  }
}
