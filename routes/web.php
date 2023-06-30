<?php

use App\Http\Controllers\RouterController;
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

Route::get('/', [RouterController::class, 'showCars'])->name('dashboard');

Route::get('/car-details/{car}', [RouterController::class, 'showCarDetails'])->name('car-details');
Route::get('/add-or-edit-car', [RouterController::class, 'showCarCreate'])->name('car-create-page');
Route::get('/add-or-edit-car/{car}', [RouterController::class, 'showCarEdit'])->name('car-edit-page');
