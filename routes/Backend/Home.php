<?php
/*
 * Home Management
 */
Route::group(['namespace' => 'Home'], function () {
		Route::get('/', 'HomeController@index')->name('home');
	});