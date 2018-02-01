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


Route::get('/v1/verify', 'L4DBotController@verification');
Route::get('/v1/register', 'L4DBotController@register');
Route::get('/v1/load/command/{request_type?}', 'L4DBotController@command_load');
Route::get('/v1/load/proceed', 'L4DBotController@proceed_load_request');

// Route::name('sms')->group(function () {
//   Route::get('/v1/sms/load/command', 'L4DBotController@command_load');
// });


Route::get('/v1/load/verify', 'L4DBotController@verify_load');
