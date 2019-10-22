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

Route::view('/promptpassword','promptpass');
Route::post('/promptpassword','Auth\LoginController@promptPassword');

Route::post('/upload','Auth\LoginController@uploadImages');
Route::get('/show','Auth\LoginController@show');

Route::post('/auth', 'Auth\LoginController@authenticate');
Route::get('/logout', 'Auth\LoginController@logout')->middleware('227');

//Admin routes
Route::get('/dashboard', 'AdminController@dashboard');

//Admin routes - Consultant
Route::get('/consultant', 'AdminController@consultantIndex');
Route::get('/consultant/add', 'AdminController@consultantAdd');
Route::get('/consultant/add/{modul_id}', 'AdminController@getSubmodules');
Route::post('/consultant/add', 'AdminController@consultantStore');

//Admin routes - Clients
Route::get('/client','AdminController@clientIndex');
Route::view('/client/add','admin.client.add');
Route::post('/client/add','AdminController@clientStore');

//Admin - Module
Route::get('/module', 'AdminController@moduleIndex');
Route::view('module/add', 'admin.module.add');
Route::post('/module/add', 'AdminController@moduleStore');

//Consultant Routes
Route::get('/home','ConsultantController@index');
