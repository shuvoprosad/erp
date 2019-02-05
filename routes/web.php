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
    Route::resource('usertype', 'UserTypeController');
    Route::resource('customers', 'CustomerController');
    Route::get('customers/search/{query}', ['as' => 'customers.search', 'uses' => 'CustomerController@search']);
    Route::resource('permissions', 'PermissionController');
    Route::resource('roles', 'RoleController');
    Route::resource('products', 'ProductController');
    Route::resource('productleads', 'ProductLeadController');
    Route::resource('productorders', 'ProductOrderController');
    Route::resource('address', 'DistrictController');
    Route::resource('status0', 'Status0Controller');
    Route::group(['prefix'=>'payments','as'=>'payments.'], function(){
        Route::get('/{order_id}', ['as' => 'index', 'uses' => 'PaymentController@index']);
        Route::get('create/{order_id}', ['as' => 'create', 'uses' => 'PaymentController@create']);
        Route::post('store/{order_id}', ['as' => 'store', 'uses' => 'PaymentController@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'PaymentController@edit']);
        Route::patch('{id}/update', ['as' => 'update', 'uses' => 'PaymentController@update']);
        Route::delete('{id}/destroy', ['as' => 'destroy', 'uses' => 'PaymentController@store']);
    });
    Route::group(['prefix'=>'orderedproducts','as'=>'o_products.'], function(){
        Route::get('/{order_id}', ['as' => 'index', 'uses' => 'OrderedProductsController@index']);
        Route::get('create/{order_id}', ['as' => 'create', 'uses' => 'OrderedProductsController@create']);
        Route::post('store/{order_id}', ['as' => 'store', 'uses' => 'OrderedProductsController@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'OrderedProductsController@edit']);
        Route::patch('{id}/update', ['as' => 'update', 'uses' => 'OrderedProductsController@update']);
        Route::delete('{id}/destroy', ['as' => 'destroy', 'uses' => 'OrderedProductsController@store']);
    });
    Route::group(['prefix'=>'salarypayment','as'=>'s_payment.'], function(){
        Route::get('/{salary_id}', ['as' => 'index', 'uses' => 'SalaryPaymentController@index']);
        Route::get('create/{salary_id}', ['as' => 'create', 'uses' => 'SalaryPaymentController@create']);
        Route::post('store/{salary_id}', ['as' => 'store', 'uses' => 'SalaryPaymentController@store']);
        Route::get('{id}/edit', ['as' => 'edit', 'uses' => 'SalaryPaymentController@edit']);
        Route::patch('{id}/update', ['as' => 'update', 'uses' => 'SalaryPaymentController@update']);
        Route::delete('{id}/destroy', ['as' => 'destroy', 'uses' => 'SalaryPaymentController@store']);
    });
    Route::resource('paymentmethod', 'PaymentMethodController');
    Route::resource('paymentnumber', 'PaymentNumberController');
    Route::resource('status0', 'Status0Controller');
    Route::resource('status1', 'Status1Controller');
    Route::resource('status2', 'Status2Controller');
    Route::resource('note2', 'Note2Controller');
    Route::resource('salaries', 'SalaryController');
});


