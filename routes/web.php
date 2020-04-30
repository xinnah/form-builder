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

	// customer info
	Route::resource('customer-info', 'CustomersInfoController');

	// form status update
	Route::post('/forms-staus-update', 'HomeController@statusUpdate');
});