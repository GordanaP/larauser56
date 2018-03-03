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


/**
 * Admin\User
 */
Route::namespace('Admin\User')->prefix('admin')->name('admin.')->group(function() {
    /**
     * Account
     */
    Route::resource('/accounts', 'AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index', 'store', 'update', 'destroy']
    ]);
});

/**
 * Admin\Role
 */
Route::namespace('Admin\Role')->prefix('admin')->name('admin.')->group(function() {
    /**
     * Role
     */
    Route::resource('/roles', 'RoleController', [
        'except' => ['create', 'edit']
    ]);

    /**
     * Permission
     */
    Route::resource('/permissions', 'PermissionController', [
        'except' => ['create', 'edit']
    ]);
});