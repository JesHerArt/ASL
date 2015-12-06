<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Homepage
Route::get('/', function () {
    return view('home');
});

//Customers Create Account Page
Route::get('/create-account', 'CustomersController@accountForm');

//Customers Main Account Page
Route::get('/account', 'CustomersController@accountMain');

//Employee Portal 'My Settings' Page
Route::get('/portal-settings', 'EmployeesController@portalSettings');

// Authentication controllers
Route::controllers([
  'auth' => '\App\Http\Controllers\Auth\AuthController',
  'password' => '\App\Http\Controllers\Auth\PasswordController'
]);
