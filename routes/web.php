<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\WelcomeController;
use App\Modules\Profile\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'get'])->name('welcome');
Route::get('/admin', [WelcomeController::class, 'admin'])->middleware(['auth', 'param:isAdmin'])->name('admin.index');

Route::get('{upload}', [FilesController::class, 'get'])->middleware(['auth'])->where('upload', '(upload\/)(.*)');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/products.php';
require __DIR__ . '/rooms.php';
require __DIR__ . '/orders.php';
