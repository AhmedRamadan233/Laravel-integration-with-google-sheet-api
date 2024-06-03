<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProcessGoogleSheetsDataController;
use App\Http\Controllers\ProductController;
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

Route::post('/process-google-sheets-data', [ProcessGoogleSheetsDataController::class, 'processGoogleSheetsData'])->name('process-google-sheets-data');
// index

Route::get('/', [ProcessGoogleSheetsDataController::class , 'index'])->name('dashboard');




// Route::get('/', function () {
//     return view('admin-dashboard.home.index');
// })->name('dashboard');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
});
