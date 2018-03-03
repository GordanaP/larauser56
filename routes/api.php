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