<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TextEditorController;
use App\Http\Controllers\WelcomeController;
use App\Modules\Profile\Controllers\ProfileController;
use App\Modules\Reviews\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'get'])->name('welcome');
Route::get('/rules', [WelcomeController::class, 'rules'])->name('welcome.rules');
Route::get('/loyalty', [WelcomeController::class, 'loyalty'])->name('welcome.loyalty');
Route::get('/service', [WelcomeController::class, 'service'])->name('welcome.service');
Route::get('/admin', [WelcomeController::class, 'admin'])->middleware(['auth', 'param:isAdmin'])->name('admin.index');
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.welcome');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('{upload}', [FilesController::class, 'get'])->where('upload', '(upload\/)(.*)');

Route::middleware('auth')->group(function () {
    Route::post('/reviews', [ReviewsController::class, 'store'])->name('reviews.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('param:reservation_view')->group(function () {
        Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
    });
    Route::middleware('param:reservation_edit')->group(function () {
        Route::get('/reservation/create', [ReservationController::class, 'create'])->name('reservation.create');
        Route::get('/reservation/{id}/edit', [ReservationController::class, 'edit'])->name('reservation.edit');
        Route::post('/reservation/store', [ReservationController::class, 'storeAdmin'])->name('reservation.storeAdmin');
        Route::patch('/reservation/{id}', [ReservationController::class, 'update'])->name('reservation.update');
        Route::delete('/reservation/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');
        Route::delete('/reservation/welcome/{id}', [ReservationController::class, 'destroyWelcome'])->name('reservation.destroyWelcome');
    });
    Route::get('/editor/rules', [TextEditorController::class, 'rulesIndex'])->name('rules.index');
    Route::get('/editor/rules/edit', [TextEditorController::class, 'rulesEdit'])->name('rules.edit');
    Route::post('/editor/rules', [TextEditorController::class, 'rulesSave'])->name('rules.save');
    Route::get('/editor/loyalty', [TextEditorController::class, 'loyaltyIndex'])->name('loyalty.index');
    Route::get('/editor/loyalty/edit', [TextEditorController::class, 'loyaltyEdit'])->name('loyalty.edit');
    Route::post('/editor/loyalty', [TextEditorController::class, 'loyaltySave'])->name('loyalty.save');
    Route::get('/editor/service', [TextEditorController::class, 'serviceIndex'])->name('service.index');
    Route::get('/editor/service/edit', [TextEditorController::class, 'serviceEdit'])->name('service.edit');
    Route::post('/editor/service', [TextEditorController::class, 'serviceSave'])->name('service.save');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/products.php';
require __DIR__ . '/rooms.php';
require __DIR__ . '/stocks.php';
require __DIR__ . '/orders.php';
require __DIR__ . '/users.php';
require __DIR__ . '/reports.php';
