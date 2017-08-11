<?php

Route::get('', 'TaskController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::post('auth/logout', 'Auth\AuthController@postLogout');

Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('tasks', 'TaskController@index');
Route::post('task', 'TaskController@store');
Route::delete('task/{task}', 'TaskController@destroy');