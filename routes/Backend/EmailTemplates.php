<?php

/*
 * Email Templates Management
 */
Route::group(['namespace'                                                 => 'EmailTemplates'], function () {
		Route::resource('emailtemplates', 'EmailTemplatesController', ['except' => ['show', 'create', 'save']]);
		Route::any('emailtemplates/{emailtemplate}/delete', 'EmailTemplatesController@delete')->name('emailtemplates.delete');
		//For DataTables
		Route::post('emailtemplates/get', 'EmailTemplatesTableController')
			->name('emailtemplates.get');
	});
