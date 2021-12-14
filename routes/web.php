<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomereturnController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\OutcomereturnController;
use App\Http\Controllers\VmutationController;

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
Route::get('outcome/print/{outcome}', [OutcomeController::class, 'print']);
Route::resource('store', StoreController::class);
Route::resource('inventory', InventoryController::class);
Route::resource('income', IncomeController::class);
Route::resource('outcome', OutcomeController::class);
Route::resource('inreturn', IncomereturnController::class);
Route::resource('outreturn', OutcomereturnController::class);
// Route::resource('mutasi', VmutationController::class);

Route::get('mutasi', [VmutationController::class, 'index'])->name('mutasi.index');
Route::get('mutasi/create', [VmutationController::class, 'create'])->name('mutasi.create');
Route::get('mutasi/{id}', [VmutationController::class, 'show'])->name('mutasi.show');

// Route::get('/store', [StoreController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });
