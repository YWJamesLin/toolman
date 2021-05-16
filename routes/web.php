<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cloudflare')->group(function () {
  Route::resources([
    'record' => 'CloudflareRecordController',
    'zone' => 'CloudflareZoneController',
  ]);
  Route::get('update', 'CloudflareController@updateAddress')
    ->name('update-address');
  Route::get('record/{record}/update-address', 'CloudflareRecordController@updateAddress')
    ->name('record.update-address');
  Route::get('zone/{zoneId}/parse', 'CloudflareZoneController@parse')
    ->name('zone.parse');
});
