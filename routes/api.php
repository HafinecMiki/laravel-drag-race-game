<?php

use App\Http\Controllers\CarsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::post('/start-race',  [CarsController::class, 'startRace'])->name('start-race');
    Route::post('/car-create',  [CarsController::class, 'store'])->name('car-create');
    Route::put('/car/{car}',    [CarsController::class, 'update'])->name('car-edit');
    Route::delete('/car/{car}', [CarsController::class, 'destroy'])->name('car-delete');
});
