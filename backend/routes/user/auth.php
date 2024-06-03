<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;


Route::middleware(['throttle:10,1'])->group(function () {
    Route::post('/register',[ UserController::class, 'register']);
    Route::post('/login',[ UserController::class, 'login']);
});