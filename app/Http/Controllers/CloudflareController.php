<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CloudflareRecord;

class CloudflareController extends Controller
{
  public function updateAddress(Request $request)
  {
      $id = $request->input('record');
      $address = $request->input('address');

      $record = CloudflareRecord::where('record', $id)->first();

      if ($record) {
        $record->updateContent($address);
      }
  }
}
