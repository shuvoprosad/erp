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
    Route::resource('customers', 'CustomerController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('roles', 'RoleController');
    Route::resource('products', 'ProductController');
    Route::resource('productleads', 'ProductLeadController');
    Route::resource('productorders', 'ProductOrderController');
    Route::group(['prefix'=>'payments','as'=>'payments.'], function(){
        Route::get('/{order_id}', ['as' => 'index', 'uses' => 'PaymentController@index']);
        Route::get('create/{order_id}', ['as' => 'create', 'uses' => 'PaymentController@create']);
        Route::post('store/{order_id}', ['as' => 'store', 'uses' => 'PaymentController@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'PaymentController@edit']);
        Route::patch('{id}/update', ['as' => 'update', 'uses' => 'PaymentController@update']);
        Route::delete('{id}/destroy', ['as' => 'destroy', 'uses' => 'PaymentController@store']);
    });
    Route::resource('salaries', 'SalaryController');
});


