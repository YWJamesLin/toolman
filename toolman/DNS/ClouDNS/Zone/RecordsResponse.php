<?php

namespace Toolman\Cloudflare\Zone;

use Toolman\Http\BaseHttpResponse;
use Toolman\Cloudflare\Zone;
use Toolman\Json\JsonArrayConvertible;

class RecordsResponse extends BaseHttpResponse
{
  use JsonArrayConvertible;

  public function property(): array
  {
    return [
      'success',
      'errors',
      'messages',
      'result',
    ];
  }

  public function __construct($jsonData)
  {
    parent::__construct($jsonData);

    $this->convertToJsonArrayGroup('result', RecordsResponseResult::class);
  }
}
