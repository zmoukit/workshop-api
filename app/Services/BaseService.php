<?php

namespace App\Services;

use Carbon\Carbon;

abstract class BaseService
{
  public $model;

  public function all()
  {
    return $this->model->all();
  }

  public function create(array $input)
  {
    return $this->model->create($input);
  }

  public function getCurrentTime()
  {
    $now = Carbon::now();
    return $now->toDateTimeString();
  }

  protected function _toArray($aData, $aAttributesException = array())
  {
    $aArray = [];
    //
    $aAttributes = $this->model->getFillable();
    foreach ($aAttributes as $attribut) {
      if (!(in_array($attribut, $aAttributesException))) {
        $aArray[$attribut] = (array_key_exists($attribut, $aData)) ? $aData[$attribut] : null;
      }
    }

    return $aArray;
  }
}
