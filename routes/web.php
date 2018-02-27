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

Route::get('/reg', 'PortalController@Reg');
Route::get('/portal/dashboard', 'PortalController@Dashboard');
Route::get('/portal/wallet/buy', 'PortalController@Wallet_Buy');
Route::get('/portal/wallet/sell', 'PortalController@Wallet_Sell');
Route::get('/portal/wallet/transactions', 'PortalController@Wallet_Transaction');

Route::get('/t/{id}', 'L4DHelper@get_wallet_summary');
Route::get('/t/prefix/mobile/{mobile}', 'L4DHelper@prefix');
Route::get('/t/{network}/{code}', 'L4DHelper@get_load_command');
Route::get('/t/remitbox/{target}/{keyword}/{reference}', 'L4DHelper@curl_execute_remitbox');
