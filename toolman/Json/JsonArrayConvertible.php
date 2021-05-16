<?php

namespace Toolman\Json;

trait JsonArrayConvertible
{
  public function convertToJsonArray($property, $className)
  {
    $jsonData = json_decode(json_encode($this->$property), true);

    $jsonArray = new $className();

    foreach ($jsonArray->property() as $key) {
      if (array_key_exists($key, $jsonData) && $jsonData[$key] != '') {
        $jsonArray->$key = $jsonData[$key];
      }
    }

    $this->$property = $jsonArray;
  }

  public function convertToJsonArrayGroup($property, $className)
  {
    $jsonDataGroup = json_decode(json_encode($this->$property), true);

    $jsonArrayGroup = [];

    foreach ($jsonDataGroup as $jsonData) {
      $jsonArray = new $className();
      foreach ($jsonArray->property() as $key) {
        if (array_key_exists($key, $jsonData) && $jsonData[$key] != '') {
          $jsonArray->$key = $jsonData[$key];
        }
      }
      array_push($jsonArrayGroup, $jsonArray);
    }

    $this->$property = $jsonArrayGroup;
  }
}
