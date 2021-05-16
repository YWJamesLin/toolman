<?php

namespace Toolman\Cloudflare\Record;

use Toolman\Cloudflare\CloudflareRequest;
use Toolman\Http\BaseHttpRequest;

class RecordUpdateRequest extends CloudflareRequest
{
  public $zoneId;
  public $recordId;
  public $method = BaseHttpRequest::METHOD_PUT;

  public function getEndpoint(): string
  {
    return sprintf('/client/v4/zones/%s/dns_records/%s', $this->zoneId, $this->recordId);
  }

  public function getResponseClassName(): string
  {
    return RecordUpdateResponse::class;
  }

  public function property(): array
  {
    return [
      'type',
      'name',
      'content',
      'ttl',
    ];
  }
}
