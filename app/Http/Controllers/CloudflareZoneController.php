<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CloudflareZone;
use App\CloudflareRecord;
use Toolman\Cloudflare\Zone\RecordsRequest;

class CloudflareZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function parse($zoneId)
    {
      $zone = CloudflareZone::where('id', $zoneId)->first();

      $request = new RecordsRequest([
        'zoneId' => $zone->zone,
      ]);

      $response = $request->send();

      if ($response->success) {
        foreach ($response->result as $record) {
          CloudflareRecord::updateRecord($record->id, $record->content, $zoneId, $record->type, $record->name);
        }
      }
    }
}
