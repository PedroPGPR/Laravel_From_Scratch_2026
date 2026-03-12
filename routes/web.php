<?php

use App\Http\Controllers\IdeaController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/ideas'); // TODO: Change this to a welcome page or something else.

Route::prefix('ideas')->group(function () {
    Route::get('/', [IdeaController::class, 'index'])
        ->middleware('auth')
        ->name('ideas.index');

    Route::get('/{idea}', [IdeaController::class, 'show'])
        ->middleware('auth')
        ->name('ideas.show');

    Route::delete('/{idea}', [IdeaController::class, 'destroy'])
        ->middleware('auth')
        ->name('ideas.destroy');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register.create');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');

Route::get('/login', [SessionsController::class, 'create'])
    ->middleware('guest')
    ->name('session.create');
Route::post('/login', [SessionsController::class, 'store'])
    ->middleware('guest')
    ->name('session.store');
Route::post('/logout', [SessionsController::class, 'destroy'])
    ->middleware('auth')
    ->name('session.destroy');
