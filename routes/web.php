<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\StepController;
use App\Models\Idea;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas');
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisteredUserController::class, 'create']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    Route::get('/login', [SessionController::class, 'create'])->name('login');
    Route::post('/login', [SessionController::class, 'store']);
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', [SessionController::class, 'destroy'])->name('logout');
    Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');
    Route::get('/ideas/create', [IdeaController::class, 'create'])->can('create', Idea::class);
    Route::get('/ideas/{idea}', [IdeaController::class, 'show'])->name('ideas.show')->can('view', 'idea');
    Route::delete('ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy')->can('delete', 'idea');
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
    
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.update');
    Route::patch('/ideas/{idea}/edit', [IdeaController::class, 'update'])->name('ideas.update');

    Route::get('/profile', [SessionController::class, 'profile']);
    Route::get('/profile/edit', [ProfileController::class, 'edit']);
    Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('steps/{step}', [StepController::class, 'update'])->name('steps.update');
});
