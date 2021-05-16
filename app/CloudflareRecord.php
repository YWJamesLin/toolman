<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CloudflareZone;
use Toolman\Cloudflare\Record\RecordUpdateRequest;

class CloudflareRecord extends Model
{
  public function updateContent($content)
  {
    $zone = $this->zone;

    $request = new RecordUpdateRequest([
      'zoneId' => $zone->zone,
      'recordId' => $this->record,
      'type' => $this->type,
      'name' => $this->domain_name,
      'content' => $content,
      'ttl' => '1',
    ]);

    $response = $request->send();

    if ($response->success == true) {
      $this->address = $content;
      $this->log($content);
      return $this->save();
    } else {
      return false;
    }
  }

  public function log($content)
  {
    $log = new CloudflareRecordLog();
    $log->record_id = $this->id;
    $log->address = $content;
    return $log->save();
  }

  public static function updateRecord($record, $address, $zoneId = null, $type = null, $domainName = null)
  {
    $model = static::where('record', $record)->first();

    if ($model) {
      $model->address = $address;
      $model->save();
    } else {
      $model = new static;
      $model->zone_id = $zoneId;
      $model->record = $record;
      $model->type = $type;
      $model->domain_name = $domainName;
      $model->address = $address;
      $model->save();
    }
  }

  public function zone()
  {
    return $this->hasOne(CloudflareZone::class, 'id', 'zone_id');
  }
}
