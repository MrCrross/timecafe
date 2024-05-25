<?php

use App\Modules\Reports\ReportsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])
    ->prefix('reports')
    ->group(function () {
        Route::get('/', [ReportsController::class, 'index'])->name('reports.index');
        Route::get('/attendance', [ReportsController::class, 'attendance'])->name('reports.attendance');
        Route::get('/profits', [ReportsController::class, 'profits'])->name('reports.profits');
    });
