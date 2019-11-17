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
    return $user;
});

Route::get('/modul/{modul_id?}','API\APIController@getModules');
Route::get('/submodul/{submodul_id?}','API\APIController@getSubmodules');
Route::get('/client/{client_id?}','API\APIController@getClients');
Route::post('/ticket/create','API\APIController@postTicket');
Route::get('/ticket','API\APIController@getTicket');
