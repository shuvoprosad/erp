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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware([ 'auth'])->group(function () {
    Route::resource('users', 'UserController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('roles', 'RoleController');
    Route::resource('products', 'ProductController');
    Route::resource('productleads', 'ProductLeadController');
    Route::resource('productorders', 'ProductOrderController');
    Route::resource('salaries', 'SalaryController');
});


