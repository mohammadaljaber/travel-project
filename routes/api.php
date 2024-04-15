<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\TravelController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('travels', [TravelController::class, 'index']);
Route::get('travels/{travel:slug}/tours', [TourController::class, 'index']);
Route::prefix('admin')->middleware('auth:sanctum')->group(function () {
    Route::post('travels', [TravelController::class, 'store']);
});
Route::post('login', LoginController::class);
Route::post('travels/{travel}/tours', [TourController::class, 'store']);
Route::put('travels/{travel}', [TravelController::class, 'update']);
