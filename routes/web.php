<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarManagementController;
use App\Http\Controllers\RentalController;

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



Auth::routes(['verify' => true]);



Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/manajemen', [CarManagementController::class, 'index'])->name('car-management.index');
    Route::post('/manajemen', [CarManagementController::class, 'store'])->name('car-management.store');
    Route::get('/', [CarController::class, 'index'])->name('cars.index');
    Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.show');
    Route::get('/my-rentals', [CarController::class, 'myRentals'])->name('cars.myRentals');
    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::get('/rentals/create', [RentalController::class, 'create'])->name('rentals.create');
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store');
    Route::post('/rentals/return', [RentalController::class, 'returnCar'])->name('rentals.return');
});