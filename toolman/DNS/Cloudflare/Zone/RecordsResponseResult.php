<?php

namespace Toolman\Cloudflare\Zone;

use Toolman\Json\JsonArray;

class RecordsResponseResult extends JsonArray
{
  public function property(): array
  {
    return [
      'id',
      'type',
      'name',
      'content',
      'proxiable',
      'proxied',
      'ttl',
      'locked',
      'zone_id',
      'zone_name',
      'created_on',
      'modified_on',
      'data',
    ];
  }
}
