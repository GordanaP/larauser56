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
Route::prefix('settings')->namespace('User')->name('users.')->group(function() {

    /**
     * Account
     */
    Route::get('/myaccount', 'AccountController@edit')->name('accounts.edit');
    Route::put('/myaccount', 'AccountController@update')->name('accounts.update');
    Route::delete('/myaccount', 'AccountController@destroy')->name('accounts.destroy');

    /**
     * Profile
     */
    Route::get('/myprofile', 'ProfileController@edit')->name('profiles.edit');
    Route::put('/myprofile', 'ProfileController@update')->name('profiles.update');
    Route::delete('/myprofile', 'ProfileController@destroy')->name('profiles.destroy');

    /**
     * Avatar
     */
    Route::get('/myavatar', 'AvatarController@edit')->name('avatars.edit');
    Route::put('/myavatar', 'AvatarController@update')->name('avatars.update');
});

/**
 * Admin
 */
Route::prefix('admin')->namespace('User')->name('admin.')->middleware('auth.admin')->group(function() {

    /**
     * Account
     */
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index', 'store', 'edit', 'update', 'destroy'],
    ]);

    /**
     * Role
     */
    Route::delete('/roles-revoke/{user}', 'RoleController@revoke')->name('roles.revoke');
    Route::resource('/roles', 'RoleController', [
        'only' => ['index', 'store', 'edit', 'update', 'destroy'],
    ]);

    /**
     * Profile
     */
    Route::resource('/profiles', 'ProfileController', [
        'parameters' => ['profiles' => 'user'],
        'only' => ['show', 'update', 'destroy'],
    ]);

    /**
     * Avatar
     */
    Route::resource('avatars', 'AvatarController', [
        'parameters' => ['avatars' => 'user'],
        'only' => ['show', 'update'],
    ]);
});