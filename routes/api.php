<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::name('api.')->group(function(){

    /**
     * Account
     */
    Route::apiResource('/accounts', 'Api\User\AccountController', [
        'parameters' => ['accounts' => 'user'],
        'only' => ['index', 'show'],
    ]);

    /**
     * Role
     */
    Route::apiResource('/roles', 'Api\User\RoleController', [
        'only' => ['index', 'show'],
    ]);
});