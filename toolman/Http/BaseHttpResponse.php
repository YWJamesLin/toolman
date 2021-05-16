<?php

namespace Toolman\Http;

use Toolman\PropertyInterface;

abstract class BaseHttpResponse implements PropertyInterface
{
  public function __construct($jsonData)
  {
    $jsonFields = json_decode($jsonData, true);

    foreach ($this->property() as $property) {
      if (in_array($property, $jsonFields) && $jsonFields[$property] != '') {
        $this->$property = $jsonFields[$property];
      }
    }
  }
}
