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
    Route::get('/accounts', 'AccountController@edit')->name('accounts.edit');
    Route::put('/accounts', 'AccountController@update')->name('accounts.update');
    Route::delete('/accounts', 'AccountController@destroy')->name('accounts.destroy');

    /**
     * Profile
     */
    Route::get('/profiles', 'ProfileController@edit')->name('profiles.edit');
    Route::put('/profiles', 'ProfileController@update')->name('profiles.update');
    Route::delete('/profiles', 'ProfileController@destroy')->name('profiles.destroy');


    /**
     * Avatar
     */
    Route::get('/avatars', 'AvatarController@edit')->name('avatars.edit');
    Route::put('/avatars', 'AvatarController@update')->name('avatars.update');
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