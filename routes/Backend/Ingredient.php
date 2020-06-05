<?php
/*
 * Ingredient Management
 */
Route::group(['namespace' => 'Ingredient'], function () {
		Route::resource('ingredient', 'IngredientController');
		Route::any('ingredient/{ingredient}/delete', 'IngredientController@roleDelete')->name('ingredient.delete');
		Route::POST('ingredient/massdestroy', 'IngredientController@massDestroy')->name('ingredient.massDestroy');
		Route::get('/status/update', 'IngredientController@updateStatus')->name('ingredient.status');
		//For Datatables
		Route::post('ingredient/get', 'IngredientTableController')->name('ingredient.get');
	});