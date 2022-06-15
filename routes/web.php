<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\User\CreateUserController;
use App\Http\Controllers\User\EditUserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::get('/', [PageController::class, 'index']);
Route::get('/users', [PageController::class, 'index']);

Route::controller(PageController::class)->middleware('auth')->group(function () {
    Route::get('/edit/{id}', 'edit');
    Route::get('/page_profile/{id}', 'page_profile');
    Route::get('/status/{id}', 'status');
    Route::get('/security/{id}', 'security');
    Route::get('/media/{id}', 'media');
});

Route::controller(EditUserController::class)->middleware('auth')->group(function () {
    Route::post('/updateAvatar/{id}', 'updateAvatar');
    Route::post('/editUserData/{id}', 'editUserData');
    Route::post('/editUserSecurity/{id}', 'editUserSecurity');
    Route::post('/editUserStatus/{id}', 'editUserStatus');
    Route::post('/store', 'store');
    Route::get('/delete/{id}', 'delete');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::controller(CreateUserController::class)->group(function () {
        Route::get('/create_user', 'create_user');
        Route::post('/storeUser', 'storeUser');
    });
});


