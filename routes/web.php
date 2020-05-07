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
    return redirect('/login');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function(){
	Route::get('/home', 'HomeController@index')->name('home');

	// form status update
	Route::post('/forms-staus-update', 'HomeController@statusUpdate');

	// forms wise customer info list
	Route::get('forms/active-list', 'HomeController@activeForms');
	// Route::get('forms-customer-info/{id}', 'HomeController@customerInfo');

	// customer info
	Route::group(['prefix' => 'forms/{formId}/'], function($id) {
		Route::get('/customer-info', 'CustomersInfoController@index');
		Route::get('/customer-info/create', 'CustomersInfoController@create');
		Route::get('/customer-info/{id}', 'CustomersInfoController@show');
		Route::get('/customer-info/{id}/edit', 'CustomersInfoController@edit');
		Route::post('/customer-info', 'CustomersInfoController@store');
		Route::post('/customer-info/{id}', 'CustomersInfoController@update');
		Route::post('/customer-info/{id}/delete', 'CustomersInfoController@destroy');
	});
});