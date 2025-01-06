<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/user/trashed', [UserController::class, 'trashedUsers']);
    Route::post('/user/restore/{user}', [UserController::class, 'restoreUser']);
    Route::delete('/user/trashed/{id}', [UserController::class, 'forceDeleteUser']);

    Route::apiResource('/user',UserController::class)->withTrashed();

});

