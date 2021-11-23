<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OutcomeController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('outcome/print', [OutcomeController::class, 'print']);
Route::resource('store', StoreController::class);
Route::resource('inventory', InventoryController::class);
Route::resource('income', IncomeController::class);
Route::resource('outcome', OutcomeController::class);

// Route::get('/store', [StoreController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });
