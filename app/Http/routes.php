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

Route::get('/', 'WelcomeController@index');

Route::resource('/employees/', 'EmployeeController');
Route::any('employees/{id}/update',['as' => 'employees.update', 'uses' => 'EmployeeController@Update']);
Route::any('employees/{id}/delete',['as' => 'employees.destroy', 'uses' => 'EmployeeController@Destroy']);
Route::get('employees/{id}',['as' => 'employees.show', 'uses' => 'EmployeeController@Show']);
Route::get('employees/{id}/edit',['as' => 'employees.edit', 'uses' => 'EmployeeController@Edit']);
//Route::any('employees/add',['as' => 'employees.store', 'uses' => 'EmployeeController@Store']);




