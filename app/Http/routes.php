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

Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function(){

    get('login', 'Auth\AuthController@getLogin');

    post('login', 'Auth\AuthController@postLogin');

    get('register', 'Auth\AuthController@getRegister');

    post('register', 'Auth\AuthController@postRegister');
    
});

Route::group(['middleware' => 'auth'], function(){

    get('auth/logout', 'Auth\AuthController@getLogout');

    get('/', 'BaseController@dashboard');

    //User resource

    Route::group(['prefix' => 'user'], function(){

        get('settings', 'UserController@settings');

        put('{user}', 'UserController@update');

        get('my-account', 'UserController@profile');

        delete('{user}', 'UserController@destroy');

    });

    Route::group(['prefix' => 'dtr'], function(){

        get('import', 'DtrController@getImport');

        get('/', 'DtrController@index');

        post('/', 'DtrController@postImport');

        get('export', 'DtrController@exportToExcel');

        delete('delete-all', 'DtrController@deleteAll');  

    });

    Route::group(['prefix' => 'employees'], function(){

        post('add-shift/{id}', 'EmployeeController@addShift');

        get('shift/{shift}/edit', 'EmployeeController@editShift');

        put('shift/{shift}', 'EmployeeController@updateShift');

        get('shift/{shift}/delete', 'EmployeeController@deleteShift');

    });

    //EmployeeController resource

    resource('employees', 'EmployeeController');

     //DepartmentController resource

    resource('departments', 'DepartmentController');

     //ShiftController resource

    resource('shifts', 'ShiftController');

    get('shifts/{id}/delete', 'ShiftController@destroy');

    get('/import-employees', 'EmployeeController@importEmployees');

    Route::group(['prefix' => 'api'], function(){

        get('/employees/view-shift', 'EmployeeController@viewShift');

    });

});