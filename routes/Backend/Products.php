<?php
/*
 * Product Management
 */
Route::group(['namespace' => 'Product'], function () {
		Route::resource('products', 'ProductsController');
		Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');
	});