<?php

namespace Toolman\Json;

use Toolman\PropertyInterface;
use Exception;
use JsonSerializable;

abstract class JsonArray implements PropertyInterface, JsonSerializable
{
  public function __get($name)
  {
    if (in_array($name, $this->property()) && array_key_exists($name, $this->_storage)) {
      return $this->_storage[$name];
    } else {
      return '';
    }
  }

  public function __set($name, $value)
  {
    if (in_array($name, $this->property())) {
      $this->_storage[$name] = $value;
      return $value;
    } else {
      throw new Exception (sprintf('%s is not a property in this object.', $name));
    }
  }

  public function jsonSerialize()
  {
    return $this->_storage;
  }

  private $_storage = [];
}
