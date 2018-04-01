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

    /**
     * Profile
     */
    Route::resource('/profiles', 'ProfileController', [
        'parameters' => ['profiles' => 'user'],
        'only' => ['edit', 'update', 'destroy']
    ]);

    /**
     * Avatar
     */
    Route::resource('avatars', 'AvatarController', [
        'parameters' => ['avatars' => 'user'],
        'only' => ['edit', 'update']
    ]);

});

/**
 * Admin
 */
Route::prefix('admin')->namespace('User')->name('admin.')->group(function() {

    /**
     * Account
     */
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index', 'store', 'edit', 'update', 'destroy']
    ]);

    /**
     * Role
     */
    Route::delete('/roles-revoke/{user}', 'RoleController@revoke')->name('roles.revoke');
    Route::resource('/roles', 'RoleController', [
        'middleware' => 'auth.admin'
    ]);

    /**
     * Profile
     */
    Route::resource('/profiles', 'ProfileController', [
        'parameters' => ['profiles' => 'user'],
        'only' => ['show', 'update', 'destroy'],
        'middleware' => 'auth.admin'
    ]);

    /**
     * Avatar
     */
    Route::resource('avatars', 'AvatarController', [
        'parameters' => ['avatars' => 'user'],
        'only' => ['show', 'update'],
        'middleware' => 'auth.admin'
    ]);
});