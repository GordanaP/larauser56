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

/**
 * Activation Token
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