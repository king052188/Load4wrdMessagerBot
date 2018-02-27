<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/v1/generate/uuid', 'L4DHelper@access_token');

Route::name('online')->group(function () {
  Route::get('/v1/web/register/{access_token}', 'L4DBotController@register_web');

  Route::get('/v1/verify/{tag}/{access_token}', 'L4DBotController@verification');
  Route::get('/v1/register/{tag}/{access_token}', 'L4DBotController@register');
  Route::get('/v1/load/command/{access_token}/{request_type?}', 'L4DBotController@command_keyword');
  Route::get('/v1/load/proceed/{access_token}', 'L4DBotController@proceed_load_request');

  Route::get('/v1/messenger/send/{access_token}/{fb_id}', 'MessengerController@send');
  Route::get('/v1/ptxt/send/{fb_id}', 'P4DController@send');
});

Route::name('sms')->group(function () {
  Route::get('/v1/sms/get', 'SMSController@get_sms');
  Route::get('/v1/sms/update/{id}', 'SMSController@update_sms');
});
