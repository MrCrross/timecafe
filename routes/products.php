<?php

use App\Modules\Products\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('products.index');
    Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show')->whereNumber('id');

    Route::middleware(['auth', 'param:products_edit'])->group(function () {
        Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
        Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit')->whereNumber('id');
        Route::post('/', [ProductsController::class, 'store'])->name('products.store');
        Route::patch('/{id}', [ProductsController::class, 'update'])->name('products.update')->whereNumber('id');
        Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy')->whereNumber('id');
    });
});
