<?php

use App\Models\Shipment;
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

Route::get('/shipments', function () {
    return Shipment::all();
});

Route::get('/shipments/{id}', function ($id) {
    return Shipment::find($id);
});

Route::post('/shipments', function (Request $request) {
    return Shipment::create($request->all());
});

Route::put('/shipments/{id}', function (Request $request, $id) {
    $shipment = Shipment::find($id);
    $shipment->update($request->all());
    return $shipment;
});

Route::delete('/shipments/{id}', function ($id) {
    Shipment::find($id)->delete();
    return 204;
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });