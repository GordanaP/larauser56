<?php

Route::view('/test', 'test');

/**
 * Auth
 */
Auth::routes();

/**
 * Page
 */
Route::get('/', 'PageController@index')->name('index');
Route::get('/home', 'PageController@home')->name('home');
Route::get('admin/dashboard', 'PageController@dashboard')->name('admin.dashboard');

/**
 * ActivationToken
 */
Route::resource('accounts/token','Auth\ActivationController', [
    'parameters' => ['token' => 'activationToken'],
    'only' => ['create', 'store', 'show']
]);

/**
 * User
 */
Route::namespace('User')->prefix('users')->name('users.')->group(function() {
    /**
     * Account
     */
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['edit', 'update', 'destroy']
    ]);
});

// Route::get('/account', 'User\AccountController@edit')->name('users.accounts.edit');


Route::get('admin/accounts', 'User\AccountController@index')->name('admin.accounts.index');
Route::post('admin/accounts', 'User\AccountController@store')->name('admin.accounts.store');
Route::put('admin/accounts/{user}', 'User\AccountController@update')->name('admin.accounts.update');

/**
 * Admin\User
 */
Route::namespace('Admin\User')->prefix('admin')->name('admin.')->group(function() {
    /**
     * Account
     */
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['destroy']
    ]);
});