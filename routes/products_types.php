<?php

use App\Modules\ProductsTypes\Controllers\ProductsTypesController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('products/types')->group(function () {
    Route::middleware(['param:products_types_view'])->group(function () {
        Route::get('/', [ProductsTypesController::class, 'index'])->name('products_types.index');
        Route::get('/{id}', [ProductsTypesController::class, 'show'])->name('products_types.show')->whereNumber('id');
    });

    Route::middleware(['param:products_types_edit'])->group(function () {
        Route::get('/create', [ProductsTypesController::class, 'create'])->name('products_types.create');
        Route::get('/{id}/edit', [ProductsTypesController::class, 'edit'])->name('products_types.edit')->whereNumber('id');
        Route::post('/', [ProductsTypesController::class, 'store'])->name('products_types.store');
        Route::patch('/{id}', [ProductsTypesController::class, 'update'])->name('products_types.update')->whereNumber('id');
        Route::delete('/{id}', [ProductsTypesController::class, 'destroy'])->name('products_types.destroy')->whereNumber('id');
    });
});




