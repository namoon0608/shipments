<?php


use App\Models\Shipment;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ShippingLineController;
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


Route::get('/shipments', [ShipmentController::class, 'index']);
Route::get('/shipments/{id}', [ShipmentController::class, 'show']);
Route::post('/shipments', [ShipmentController::class, 'store']);
Route::put('/shipments/{id}', [ShipmentController::class, 'update']);
Route::delete('/shipments/{id}', [ShipmentController::class, 'destroy']);
Route::get('/shipments/{id}/history', [ShipmentController::class, 'history']);

Route::get('/statuses', [StatusController::class, 'index']);
Route::get('/statuses/{id}', [StatusController::class, 'show']);
Route::post('/statuses', [StatusController::class, 'store']);
Route::put('/statuses/{id}', [StatusController::class, 'update']);
Route::delete('/statuses/{id}', [StatusController::class, 'destroy']);

Route::get('/shipping-lines', [ShippingLineController::class, 'index']);
Route::post('/shipping-lines', [ShippingLineController::class, 'store']);
Route::put('/shipping-lines/{id}', [ShippingLineController::class, 'update']);
Route::delete('/shipping-lines/{id}', [ShippingLineController::class, 'destroy']);