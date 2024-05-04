<?php

use App\Modules\Stocks\Controllers\StocksController;
use Illuminate\Support\Facades\Route;

Route::get('/stocks/welcome', [StocksController::class, 'welcome'])->name('stocks.welcome');
Route::middleware(['auth'])->prefix('stocks')->group(function () {
    Route::middleware(['param:stocks_view'])->group(function () {
        Route::get('/', [StocksController::class, 'index'])->name('stocks.index');
        Route::get('/{id}', [StocksController::class, 'show'])->name('stocks.show')->whereNumber('id');
    });

    Route::middleware(['param:stocks_edit'])->group(function () {
        Route::get('/create', [StocksController::class, 'create'])->name('stocks.create');
        Route::get('/{id}/edit', [StocksController::class, 'edit'])->name('stocks.edit')->whereNumber('id');
        Route::post('/', [StocksController::class, 'store'])->name('stocks.store');
        Route::patch('/{id}', [StocksController::class, 'update'])->name('stocks.update')->whereNumber('id');
        Route::delete('/{id}', [StocksController::class, 'destroy'])->name('stocks.destroy')->whereNumber('id');
    });
});




