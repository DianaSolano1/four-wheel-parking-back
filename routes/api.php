<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/vehicle', [VehicleController::class, 'create']);
Route::get('/vehicle/all', [VehicleController::class, 'getAll']);
Route::get('/vehicle/{plate}', [VehicleController::class, 'findByPlate']);

Route::get('/owner/{documentId}', [OwnerController::class, 'findByDocument']);

Route::get('/brand/vehicles', [BrandController::class, 'getVehiclesCount']);
