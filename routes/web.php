<?php

use App\Http\Controllers\CreateUserController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/** for create fake userdata */
//Route::get('/fakeusers', function() {
//    factory(App\User::class, 25)->create();
//    dd();
//});

Route::middleware('auth')->group(function(){
    Route::get('/', [PageController::class, 'index']);
    Route::get('/users', [PageController::class, 'index']);
    Route::get('/page_profile{id}', [PageController::class, 'page_profile']);
    Route::get('/status{id}', [PageController::class, 'status']);
    Route::get('/security{id}', [PageController::class, 'security']);
    Route::get('/media{id}', [PageController::class, 'media']);
    Route::get('/edit{id}', [PageController::class, 'edit']);

    Route::get('/delete{id}', [EditUserController::class, 'delete']);
    Route::post('/updateAvatar{id}', [EditUserController::class, 'updateAvatar']);
    Route::post('/store', [EditUserController::class, 'store']);
    Route::post('/editUserData{id}', [EditUserController::class, 'editUserData']);
    Route::post('/editUserSecurity{id}', [EditUserController::class, 'editUserSecurity']);
    Route::post('/editUserStatus{id}', [EditUserController::class, 'editUserStatus']);

    Route::get('/logout', [UserController::class, 'logout']);
});

Route::middleware(['auth', 'admin'])->group(function() {
    Route::get('/create_user', [CreateUserController::class, 'create_user']);
    Route::post('/storeUser', [CreateUserController::class, 'storeUser']);
});

require __DIR__.'/auth.php';
