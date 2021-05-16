<?php

namespace Toolman\Cloudflare\Zone;

use Toolman\Cloudflare\CloudflareRequest;
use Toolman\Http\BaseHttpRequest;

class RecordsRequest extends CloudflareRequest
{
  public $zoneId;
  public $method = BaseHttpRequest::METHOD_GET;
  public $per_page = 100;

  public function getEndpoint(): string
  {
    return sprintf('/client/v4/zones/%s/dns_records', $this->zoneId);
  }

  public function getResponseClassName(): string
  {
    return RecordsResponse::class;
  }

  public function property(): array
  {
    return [
      'per_page',
    ];
  }
}
