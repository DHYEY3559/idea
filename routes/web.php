<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [RegisteredUserController::class, 'create']);
Route::get('/', [IdeaController::class, 'create']);

Route::get('/login', [SessionController::class, 'create']);
