<?php
/*
 * Permission Management
 */
Route::group(['namespace' => 'Permission'], function () {
		Route::resource('permissions', 'PermissionsController');
		Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
	});