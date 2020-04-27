<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



use ADR\User\Action\User\UserListAction;
use ADR\User\Action\User\UserViewAction;
use ADR\User\Action\User\UserStoreAction;
use ADR\User\Action\User\UserUpdateAction;
use ADR\User\Action\User\UserDestroyAction;
/*HEADER*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

        Route::prefix('users')->group(function () {
        Route::get('/', UserListAction::class);
        Route::post('/', UserStoreAction::class);
        Route::get('/{user}', UserViewAction::class);
        Route::put('/{user}', UserUpdateAction::class);
        Route::delete('/{user}', UserDestroyAction::class);
    });
/*BODY*/
});

