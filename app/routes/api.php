<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VehicleBrandController;
use App\Http\Controllers\API\UserVehicleController;

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
Route::resource('vehicles', UserVehicleController::class)->only(['index', 'store']);
Route::resource('vehicles/brands', VehicleBrandController::class)->only(['index']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
