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

Route::get('/', function () {
    return view('home');
});

Route::get('/customers', function () {
    return view('customer_login');
});

Route::get('/employees', function () {
    return view('employee_login');
});

Route::get('/portal-settings', function () {
    return view('portal_settings');
});