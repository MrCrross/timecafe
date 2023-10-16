<?php

use App\Modules\Orders\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('orders')->group(function () {
    Route::middleware(['param:orders_view'])->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrdersController::class, 'show'])->name('orders.show')->whereNumber('id');
    });

    Route::middleware(['param:orders_edit'])->group(function () {
        Route::get('/create', [OrdersController::class, 'create'])->name('orders.create');
        Route::get('/{id}/edit', [OrdersController::class, 'edit'])->name('orders.edit')->whereNumber('id');
        Route::post('/', [OrdersController::class, 'store'])->name('orders.store');
        Route::patch('/{id}', [OrdersController::class, 'update'])->name('orders.update')->whereNumber('id');
        Route::delete('/{id}', [OrdersController::class, 'destroy'])->name('orders.destroy')->whereNumber('id');
    });
});
