<?php

use App\Http\Controllers\CrptoPricesController;
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

Route::get('/', [CrptoPricesController::class, 'displayPrices']);

Route::get('/update_prices', [CrptoPricesController::class, 'getPrices']);

Route::post('/prices/{period}', [CrptoPricesController::class, 'getSortedPrices'])->name('sortedPrices');
