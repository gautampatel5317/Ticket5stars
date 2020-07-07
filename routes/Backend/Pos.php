<?php
/*
 * Pos Management
 */
Route::group(['namespace' => 'Pos'], function () {
    Route::resource('pos', 'PosController');
    //For Datatables
    Route::post('pos/get', 'PosTableController')->name('pos.get');
    Route::post('pos/changeStatus', 'PosController@changeStatus'); //For update status
});
