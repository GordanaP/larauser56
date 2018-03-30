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
        'except' => ['index', 'create', 'store']
    ]);
});

// Route::prefix('account')->namespace('User')->name('users.accounts.')->group(function() {
//     /**
//      * Account
//      */
//     Route::get('/', 'AccountController@edit')->name('edit');
//     Route::put('/', 'AccountController@update')->name('update');
//     Route::delete('/', 'AccountController@destroy')->name('destroy');
// });

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
});




