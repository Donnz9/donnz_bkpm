<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ApiPendidikanController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ApiPendidikanController::class)->group(function () {
    Route::get('api_pendidikan', 'getAll');
    Route::get('api_pendidikan/{id}', 'getPen');
    Route::post('api_pendidikan', 'createPen');
    Route::put('api_pendidikan/{id}', 'updatePen');
    Route::delete('api_pendidikan/{id}', 'deletePen');
});