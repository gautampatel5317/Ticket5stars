<?php
/*
 * Users Management
 */
Route::group(['namespace' => 'User'], function () {
		Route::resource('users', 'UsersController');
		Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
	});