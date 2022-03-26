<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\User\EditUserController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Status;
use App\Models\User;

require __DIR__ . '/auth.php';

Route::get('test', function () {

});

Route::middleware('auth')->group(function () {
    Route::controller(PageController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/users', 'index');
        Route::get('/page_profile{id}', 'page_profile');
        Route::get('/status{id}', 'status');
        Route::get('/security{id}', 'security');
        Route::get('/media{id}', 'media');
        Route::get('/edit{id}', 'edit');
    });

    Route::controller(EditUserController::class)->group(function () {
        Route::get('/delete/{id}', 'delete');
        Route::post('/updateAvatar{id}', 'updateAvatar');
        Route::post('/store', 'store');
        Route::post('/editUserData{id}', 'editUserData');
        Route::post('/editUserSecurity{id}', 'editUserSecurity');
        Route::post('/editUserStatus{id}', 'editUserStatus');
    });

    Route::get('/logout', [UserController::class, 'logout']);
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::controller(CreateUserController::class)->group(function () {
        Route::get('/create_user', 'create_user');
        Route::post('/storeUser', 'storeUser');
    });

    Route::get('/fakeusers', function () {
        factory(App\User::class, 25)->create();
    });
});

