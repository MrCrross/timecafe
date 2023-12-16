<?php

use App\Modules\Rooms\Controllers\RoomsController;
use App\Modules\Rooms\Controllers\RoomsRatesController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', [RoomsController::class, 'welcome'])->name('rooms.welcome');
Route::middleware(['auth'])->prefix('rooms')->group(function () {
    Route::get('/reservations/welcome', [RoomsController::class, 'welcomeReservations'])->name('reservations.welcome');
    Route::middleware(['param:rooms_view'])->group(function () {
        Route::get('/', [RoomsController::class, 'index'])->name('rooms.index');
        Route::get('/{id}', [RoomsController::class, 'show'])->name('rooms.show')->whereNumber('id');
    });

    Route::middleware(['param:rooms_edit'])->group(function () {
        Route::get('/create', [RoomsController::class, 'create'])->name('rooms.create');
        Route::get('/{id}/edit', [RoomsController::class, 'edit'])->name('rooms.edit')->whereNumber('id');
        Route::post('/', [RoomsController::class, 'store'])->name('rooms.store');
        Route::patch('/{id}', [RoomsController::class, 'update'])->name('rooms.update')->whereNumber('id');
        Route::delete('/{id}', [RoomsController::class, 'destroy'])->name('rooms.destroy')->whereNumber('id');
        Route::post('/{room_id}/images', [RoomsController::class, 'storeImage'])->name('rooms_images.store')->whereNumber('room_id');
        Route::delete('/images/{image_id}', [RoomsController::class, 'deleteImage'])->name('rooms_images.delete')->whereNumber('image_id');
    });

    Route::prefix('rates')->group(function () {
        Route::middleware(['param:rooms_rates_view'])->group(function () {
            Route::get('/', [RoomsRatesController::class, 'index'])->name('rooms_rates.index');
            Route::get('/{id}', [RoomsRatesController::class, 'show'])->name('rooms_rates.show')->whereNumber('id');
        });

        Route::middleware(['param:rooms_rates_edit'])->group(function () {
            Route::get('/create', [RoomsRatesController::class, 'create'])->name('rooms_rates.create');
            Route::get('/{id}/edit', [RoomsRatesController::class, 'edit'])->name('rooms_rates.edit')->whereNumber('id');
            Route::post('/', [RoomsRatesController::class, 'store'])->name('rooms_rates.store');
            Route::patch('/{id}', [RoomsRatesController::class, 'update'])->name('rooms_rates.update')->whereNumber('id');
            Route::delete('/{id}', [RoomsRatesController::class, 'destroy'])->name('rooms_rates.destroy')->whereNumber('id');
        });
    });
});




