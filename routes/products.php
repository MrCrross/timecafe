<?php

use App\Modules\Products\Controllers\ProductsController;
use App\Modules\ProductsTypes\Controllers\ProductsTypesController;
use Illuminate\Support\Facades\Route;

Route::prefix('products')->group(function () {
    Route::get('/welcome', [ProductsController::class, 'welcome'])->name('products.welcome');
    Route::get('/export', [ProductsController::class, 'export'])->name('products.export');

    Route::middleware(['auth'])->group(function () {
        Route::middleware(['param:products_view'])->group(function () {
            Route::get('/', [ProductsController::class, 'index'])->name('products.index');
            Route::get('/{id}', [ProductsController::class, 'show'])->name('products.show')->whereNumber('id');
        });

        Route::middleware(['param:products_edit'])->group(function () {
            Route::get('/create', [ProductsController::class, 'create'])->name('products.create');
            Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('products.edit')->whereNumber('id');
            Route::post('/', [ProductsController::class, 'store'])->name('products.store');
            Route::patch('/{id}', [ProductsController::class, 'update'])->name('products.update')->whereNumber('id');
            Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('products.destroy')->whereNumber('id');
        });

        Route::prefix('types')->group(function () {
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
    });
});


