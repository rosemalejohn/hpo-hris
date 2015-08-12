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

    Route::get('/excel', 'ExcelController@getImport');

    Route::get('/excel/view-all', 'ExcelController@getAll');

    Route::post('/excel', 'ExcelController@postImport');

    Route::get('/dtr/export', 'DtrController@dtrToExcel');

    Route::get('/dtr/export-summary', 'DtrController@dtrSummaryToExcel');

    Route::resource('employees', 'EmployeeController');

    Route::resource('departments', 'DepartmentController');

    Route::resource('shifts', 'ShiftController');

});
