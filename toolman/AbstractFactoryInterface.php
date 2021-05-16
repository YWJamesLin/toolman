<?php

namespace Toolman;

interface AbstractFactoryInterface
{
  public function getInstance (string $type);
}
