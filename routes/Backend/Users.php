<?php
/*
 * Users Management
 */
Route::group(['namespace' => 'User'], function () {
		Route::resource('users', 'UsersController');
		Route::any('users/{user}/delete', 'UsersController@deleteUser')->name('users.delete');
		Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
		// For Datatables
		Route::post('users/get', 'UserTableController')->name('users.get');
	});