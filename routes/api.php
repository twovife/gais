<?php

use App\Http\Controllers\ApiGeneralAffairController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiStoreController;
use App\Http\Controllers\ApiInventoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('store', [ApiGeneralAffairController::class, 'store']);
Route::get('inventory', [ApiGeneralAffairController::class, 'Inventory']);
Route::get('gaisstock', [ApiGeneralAffairController::class, 'BarangMasuk']);
Route::get('barangkeluar', [ApiGeneralAffairController::class, 'BarangKeluar']);
Route::get('isitembtbduplicate', [ApiGeneralAffairController::class, 'isExistItem']);
Route::get('laststock', [ApiGeneralAffairController::class, 'lastStock']);
Route::get('mutasi', [ApiGeneralAffairController::class, 'vmutasi']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
