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

//auth things
Route::post('/auth', 'Auth\LoginController@authenticate');
Route::get('/logout', 'Auth\LoginController@logout')->middleware('227');

Route::middleware(['admin'])->group(function(){

  Route::post('/upload','Auth\LoginController@uploadImages');
  Route::get('/show','Auth\LoginController@show');

  //Admin routes
  Route::get('/dashboard', 'AdminController@dashboard');

  //Admin chart ajax
  Route::get('/dashboard/chartdata', 'AdminController@getChartData');

  //Admin routes - Consultant
  Route::get('/consultant', 'AdminController@consultantIndex');
  Route::get('/consultant/add', 'AdminController@consultantAdd');
  Route::get('/consultant/add/{modul_id}', 'AdminController@getSubmodules');
  Route::post('/consultant/add', 'AdminController@consultantStore');
  Route::get('/consultant/{eid}/deactivate','AdminController@consultantDeactivate');
  Route::get('/consultant/{eid}/edit','AdminController@consultantOptions');
  Route::put('/consultant/{eid}','AdminController@consultantUpdate');
  Route::get('/consultant/{eid}/reset','AdminController@consultantResetPassword');

  //Admin routes - Clients
  Route::get('/client','AdminController@clientIndex');
  Route::view('/client/add','admin.client.add');
  Route::post('/client/add','AdminController@clientStore');
  Route::get('/client/{id}/edit','AdminController@clientOptions');
  Route::put('/client/{id}','AdminController@clientUpdate');
  Route::get('/client/{id}/delete','AdminController@clientDelete');
  Route::Get('/pic/{id}/approve','AdminController@clientPicApprove');
  Route::Get('/pic/{id}/unapprove','AdminController@clientPicUnapprove');

  //Admin - Module
  Route::get('/module', 'AdminController@moduleIndex');
  Route::view('module/add', 'admin.module.add');
  Route::post('/module/add', 'AdminController@moduleStore');
  Route::get('/module/{id}/edit','AdminController@moduleOptions');
  Route::put('/module/{id}','AdminController@moduleUpdate');

  //Admin - Settings
  Route::get('/admin/settings','AdminController@settingsIndex');
  Route::post('/admin/settings/{eid}','AdminController@settingsUpdatePassword');
});

Route::middleware(['check.login'])->group(function(){
  //Prompt change password -First Time Login
  Route::view('/promptpassword','promptpass');
  Route::post('/promptpassword','Auth\LoginController@promptPassword');

  //Consultant Routes
  Route::get('/overview','ConsultantController@index');
  Route::get('/activityfeed','ConsultantController@getActivityFeed');

  //Consultant chart ajax
  Route::get('/overview/chartdata','ConsultantController@getChartData');

  //Consultant routes - Ticket
  Route::view('/ticket','consultant/ticket');
  Route::get('/ticket/{id}','ConsultantController@ticketView');
  Route::get('/ticket/{id}/changestatus','ConsultantController@ticketChangeStatus');

  //Consultant- AJAX Ticket
  Route::get('/ticketdata','ConsultantController@ticketIndex');

  //Consultant routes - Settings
  Route::view('/consultant/settings','consultant.settings');
  Route::post('/consultant/settings/{eid}/password','ConsultantController@settingsChangePassword');
  Route::post('/consultant/settings/{eid}/profile','ConsultantController@settingsUpdateProfile');
});
