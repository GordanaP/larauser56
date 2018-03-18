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
Route::prefix('users')->namespace('User')->name('users.')->group(function() {
    /**
     * Account
     */
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['edit', 'update', 'destroy']
    ]);
});

// Route::get('/account', 'User\AccountController@edit')->name('users.accounts.edit');

/**
 * Admin
 */
Route::prefix('admin')->namespace('User')->name('admin.')->group(function() {
    /**
     * Account
     */
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index', 'store', 'update', 'destroy']
    ]);
});

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