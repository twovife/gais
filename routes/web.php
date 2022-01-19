<?php

use App\Http\Controllers\BkbController;
use App\Http\Controllers\BtbController;
use App\Http\Controllers\ChangepassController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\IncomereturnController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OutcomeController;
use App\Http\Controllers\OutcomereturnController;
use App\Http\Controllers\RegistrationController;
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

Route::middleware('auth')->group(function () {
     Route::get('/', [HomeController::class, 'index']);
     Route::get('outcome/print/{outcome}', [OutcomeController::class, 'print'])->name('outcome.print');


     Route::get('store', [StoreController::class, 'index'])->name('store.index');
     Route::post('store', [StoreController::class, 'store'])->name('store.store');
     Route::put('store/{store}', [StoreController::class, 'update'])->name('store.update');
     Route::put('store/restore/{store}', [StoreController::class, 'restore'])->name('store.restore');
     Route::delete('store/{store}', [StoreController::class, 'destroy'])->name('store.destroy');

     // Route::resource('store', StoreController::class);
     Route::put('inventory/restore/{inventory}', [InventoryController::class, 'restore'])->name('inventory.restore');
     Route::resource('inventory', InventoryController::class);
     Route::resource('income', IncomeController::class);
     Route::resource('outcome', OutcomeController::class);
     Route::resource('inreturn', IncomereturnController::class);
     Route::resource('outreturn', OutcomereturnController::class);


     // Route::resource('mutasi', VmutationController::class);
     Route::get('mutasi', [VmutationController::class, 'index'])->name('mutasi.index');
     Route::get('mutasi/create', [VmutationController::class, 'create'])->name('mutasi.create');
     Route::get('mutasi/{id}', [VmutationController::class, 'show'])->name('mutasi.show');


     // register users
     Route::get('users', [RegistrationController::class, 'create'])->name('register');
     Route::post('users', [RegistrationController::class, 'store']);

     Route::get('chpass', [ChangepassController::class, 'show'])->name('chpass');
     Route::put('chpass/{chpass}', [ChangepassController::class, 'update'])->name('chpass.update');

     Route::post('logout', [LogoutController::class, '__invoke'])->name('logout');

     Route::get('btb', [BtbController::class, 'index'])->name('btb.index');
     Route::get('btb/{income}', [BtbController::class, 'show'])->name('btb.show');

     Route::get('bkb', [BkbController::class, 'index'])->name('bkb.index');
     Route::get('bkb/{outcome}', [BkbController::class, 'show'])->name('bkb.show');
});





Route::middleware('guest')->group(function () {
     Route::get('login', [LoginController::class, 'create'])->name('login');
     Route::post('login', [LoginController::class, 'store']);
});
     // login


// Route::get('/store', [StoreController::class, 'index']);
// Route::get('/', function () {
//     return view('welcome');
// });
