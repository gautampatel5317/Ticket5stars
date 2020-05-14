<?php
/*
 * Role Management
 */
Route::group(['namespace' => 'Role'], function () {
		Route::resource('roles', 'RolesController');
		Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
	});