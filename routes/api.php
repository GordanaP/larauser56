<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Account
 */
Route::get('/accounts', 'Api\User\AccountController@index')->name('api.accounts.index');
Route::get('/accounts/{user}', 'Api\User\AccountController@show')->name('api.accounts.show');

/**
 * Permission
 */
Route::get('/permissions', 'Api\PermissionController@index')->name('api.permissions.index');
Route::get('/permissions/{permission}', 'Api\PermissionController@show')->name('api.permissions.show');