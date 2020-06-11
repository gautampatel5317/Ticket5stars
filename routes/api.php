<?php
Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
		Route::group(['prefix'  => 'auth', 'middleware'  => ['guest']], function () {
				Route::post('register', 'AuthController@register');
				Route::post('login', 'AuthController@authenticate');
			});
		Route::group(['middleware' => ['jwt.verify']], function () {
				Route::get('user', 'AuthController@getAuthenticatedUser');
				Route::any('logout', 'AuthController@logout');
				// Users
				Route::resource('users', 'UsersApiController', ['except' => ['create', 'edit']]);
			});
	});

// Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
// 		Route::apiResource('permissions', 'PermissionsApiController');
// 		Route::apiResource('roles', 'RolesApiController');
// 		Route::apiResource('users', 'UsersApiController');
// 		Route::apiResource('products', 'ProductsApiController');
// 		Route::apiResource('customers', 'CustomersApiController');
// 		Route::apiResource('cms', 'CmsApiController');
// 	});
