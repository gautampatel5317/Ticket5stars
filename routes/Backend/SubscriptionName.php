<?php
/*
 * SubscriptionName Management
 */
Route::group(['namespace' => 'SubscriptionName'], function () {
	Route::resource('subscriptionname', 'SubscriptionNameController');
	//For Datatables
    Route::post('subscriptionname/get', 'SubscriptionNameTableController')->name('subscriptionname.get');
    Route::post('subscriptionname/changeStatus', 'SubscriptionNameController@changeStatus');//For update status
});
