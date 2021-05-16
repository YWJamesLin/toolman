<?php

namespace Toolman\Cloudflare\Record;

use Toolman\Http\BaseHttpResponse;
use Toolman\Cloudflare\Zone;
use Toolman\Json\JsonArrayConvertible;

class RecordUpdateResponse extends BaseHttpResponse
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

    $this->convertToJsonArray('result', RecordUpdateResponseResult::class);
  }
}
