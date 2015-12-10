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

//Website Homepage
Route::get('/', function () {
    return view('home');
});



/*
|--------------------------------------------------------------------------
| CUSTOMERS' PORTION OF THE SITE
|--------------------------------------------------------------------------
*/

//Create Account
Route::get('/create-account', 'CustomersController@accountForm');

//Main Account Page
Route::get('/account', 'CustomersController@accountMain');

//Change Password
Route::get('/user-credentials', 'CustomersController@editPassword');
Route::post('/user-credentials', 'CustomersController@updatePassword');



/*
|--------------------------------------------------------------------------
| EMPLOYEES' PORTION OF THE SITE
|--------------------------------------------------------------------------
*/

//My Settings
Route::get('/portal-settings', 'EmployeesController@portalSettings');

//My Employees
Route::get('/portal-employees', 'EmployeesController@portalEmployees');

//Edit My Employees
Route::get('/portal-edit-employee/{id}', 'EmployeesController@portalEditEmployee');
Route::post('/portal-edit-employee', 'EmployeesController@portalUpdateEmployee');

//Add New Employee
Route::get('/portal-new-employee', 'EmployeesController@portalNewEmployeeForm');
Route::post('/portal-new-employee', 'EmployeesController@portalCreateEmployee');

//Edit My Settings
Route::get('/portal-edit-settings', 'EmployeesController@portalEditSettings');
Route::post('/portal-edit-settings', 'EmployeesController@portalUpdateSettings');

//Change Password
Route::get('/portal-user-credentials', 'EmployeesController@portalEditPassword');
Route::post('/portal-user-credentials', 'EmployeesController@updatePassword');

//Timesheet
Route::get('/portal-timesheet', 'EmployeesController@portalTimesheet');
Route::post('/portal-timesheet', 'EmployeesController@portalUpdateTimesheet');



/*
|--------------------------------------------------------------------------
| AUTHENTICATION CONTROLLER
|--------------------------------------------------------------------------
*/

Route::controllers([
  'auth' => '\App\Http\Controllers\Auth\AuthController',
  'password' => '\App\Http\Controllers\Auth\PasswordController'
]);
