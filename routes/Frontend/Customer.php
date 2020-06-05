<?php
/*
 * Customer Management
 */
//Route::group(['namespace' => 'Customer'], function () {
		//Route::get('customer', 'CustomerController@index');
//	});
Route::group(['namespace' => 'Customer'], function () {
		Route::resource('customer', 'CustomerController');
	});