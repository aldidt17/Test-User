<?php

use App\Http\Controllers\UsersController;
use App\Http\Middleware\LogRequestMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([LogRequestMiddleware::class])->group(function () {
    Route::resource('users', UsersController::class);
});