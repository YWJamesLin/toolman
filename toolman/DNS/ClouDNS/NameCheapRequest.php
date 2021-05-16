<?php

namespace Toolman\Cloudflare;

use Toolman\Http\BaseHttpRequest;
use App\Parameter;

abstract class CloudflareRequest extends BaseHttpRequest
{
  public function __construct($_configs = [])
  {
    parent::__construct($_configs);

    $tokenParameter = Parameter::where('category', 'cloudflare')->where('name', 'api_key')->first();
    $emailParameter = Parameter::where('category', 'cloudflare')->where('name', 'email')->first();

    $this->headers = [
      'Content-Type' => 'application/json',
      'X-Auth-Key' => $tokenParameter->value,
      'X-Auth-Email' => $emailParameter->value,
    ];
  }

  public function getEndpointBase(): string
  {
    return 'https://api.cloudflare.com';
  }
}
