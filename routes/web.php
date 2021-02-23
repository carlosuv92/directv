<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', function () {
    return redirect('almacen/dashboard');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('almacen')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Almacen\DashboardController::class, 'index'])->name('almacen.dashboard');
    Route::get('/guide-list', [App\Http\Controllers\Almacen\GuideController::class, 'index'])->name('almacen.listguide');
    Route::get('/warehouse/insert/{id}', [App\Http\Controllers\Almacen\WarehouseController::class, 'index'])->name('warehouse.index');
    Route::post('/warehouse', [App\Http\Controllers\Almacen\WarehouseController::class, 'store'])->name('warehouse.store');
    Route::get('/warehouse/give', [App\Http\Controllers\Almacen\WarehouseController::class, 'list'])->name('warehouse.give');
    Route::post('/warehouse/decos', [App\Http\Controllers\Almacen\WarehouseController::class, 'storeDecos'])->name('warehouse.decos');
});

Route::resource('guides', App\Http\Controllers\Almacen\GuideController::class);
Route::prefix('guides')->group(function () {
});
