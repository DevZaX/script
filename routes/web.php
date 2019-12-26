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

Route::get( '/',"HomeController@home" );
Route::get( "/login","LoginController@home" )->name("login");
Route::post( "/login","LoginController@login" );
Route::get( "/logout","LoginController@logout" );
Route::post("/DescribeInstances","AWSController@DescribeInstances");
Route::post("/start","AWSController@start");
Route::get("/settings","SettingsController@home");
Route::post("/update","HomeController@update");
Route::get("/accounts","AccountController@home");
Route::post("/saveAccount","AccountController@saveAccount");
Route::get("/getAccounts","AccountController@getAccounts");
Route::delete("/deleteAccount/{id}","AccountController@deleteAccount");
Route::put("/updateAccount/{id}","AccountController@updateAccount");