<?php

use App\Modules\Users\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('users')->group(function () {
    Route::middleware(['param:users_view'])->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index');
        Route::get('/{id}', [UsersController::class, 'show'])->name('users.show')->whereNumber('id');
    });

    Route::middleware(['param:users_edit'])->group(function () {
        Route::get('/create', [UsersController::class, 'create'])->name('users.create');
        Route::get('/{id}/edit', [UsersController::class, 'edit'])->name('users.edit')->whereNumber('id');
        Route::post('/', [UsersController::class, 'store'])->name('users.store');
        Route::patch('/{id}', [UsersController::class, 'update'])->name('users.update')->whereNumber('id');
        Route::delete('/{id}', [UsersController::class, 'destroy'])->name('users.destroy')->whereNumber('id');
    });
});
