<?php
/*
 * Subscription Management
 */
Route::group(['namespace' => 'Subscription'], function () {
	Route::resource('subscription', 'SubscriptionController');
	//For Datatables
    Route::post('subscription/get', 'SubscriptionTableController')->name('subscription.get');
    Route::post('subscription/changeStatus', 'SubscriptionController@changeStatus');//For update status
});
