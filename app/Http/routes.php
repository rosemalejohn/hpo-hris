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

Route::group(['middleware' => 'guest'], function(){

    Route::get('auth/login', 'Auth\AuthController@getLogin');

    Route::post('auth/login', 'Auth\AuthController@postLogin');

    Route::get('auth/register', 'Auth\AuthController@getRegister');

    Route::post('auth/register', 'Auth\AuthController@postRegister');
});

Route::group(['middleware' => 'auth'], function(){

    Route::get('auth/logout', 'Auth\AuthController@getLogout');

    Route::get('/', 'BaseController@dashboard');

    //Daily Time Record Resource

    Route::get('/dtr/import', 'DtrController@getImport');

    Route::get('/dtr', 'DtrController@index');

    Route::post('/dtr', 'DtrController@postImport');

    Route::get('/dtr/export', 'DtrController@exportToExcel');
    // Route::get('/dtr/export', 'ExportExcelController@export');

    //EmployeeController resource

    Route::resource('employees', 'EmployeeController');

     //DepartmentController resource

    Route::resource('departments', 'DepartmentController');

     //ShiftController resource

    Route::resource('shifts', 'ShiftController');

    Route::get('/import-employees', 'EmployeeController@importEmployees');
});