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

Route::post('/modul','API\APIController@getModules');
Route::post('/submodul/{submodul_id?}','API\APIController@getSubmodules');
Route::post('/client/{client_id?}','API\APIController@getClients');
Route::post('/ticket/create','API\APIController@postTicket');
Route::post('/ticket/{id}','API\APIController@getTicket');
Route::post('/ticket','API\APIController@getTickets');

Route::post('/register','API\AuthController@register');
Route::post('/login','API\AuthController@login');
Route::post('/profile/update','API\APIController@updateInfo');
