<?php

use Classes\Route;

Route::get('/', ['as' => 'login.index', 'action' => 'Controllers\LoginController@index']);
Route::get('/login', ['as' => 'login.index', 'action' => 'Controllers\LoginController@index']);
Route::get('/logout', ['as' => 'login.logout', 'action' => 'Controllers\LoginController@logout']);
Route::post('/login', ['as' => 'login.access', 'action' => 'Controllers\LoginController@loginAccess']);

Route::get('/home', ['as' => 'home.index', 'action' => 'Controllers\HomePageController@index']);

Route::get('/customers', ['as' => 'customers.index', 'action' => 'Controllers\CustomerController@index']);
Route::get('/customers-register', ['as' => 'customers.register', 'action' => 'Controllers\CustomerController@register']);
Route::get('/customers-all', ['as' => 'customers.all', 'action' => 'Controllers\CustomerController@all']);
Route::post('/customers-post', ['as' => 'customers-post', 'action' => 'Controllers\CustomerController@post']);
Route::post('/customers-delete', ['as' => 'customers-delete', 'action' => 'Controllers\CustomerController@delete']);
Route::post('/customer-info', ['as' => 'customer-info', 'action' => 'Controllers\CustomerController@info']);

Route::run();