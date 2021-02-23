<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST,GET,PUT,PATCH,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

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

Route::post('get_users', [App\Http\Controllers\Api\ApiUserController::class, 'getUsers']);
Route::post('get_users_byrole', [App\Http\Controllers\Api\ApiUserController::class, 'getUsersByRole']);
Route::get('get_guides', [App\Http\Controllers\Api\ApiWarehouseController::class, 'getListGuide']);
Route::get('get_decos', [App\Http\Controllers\Api\ApiWarehouseController::class, 'getListDecos']);
Route::get('get_all_decos', [App\Http\Controllers\Api\ApiWarehouseController::class, 'getAllListDecos']);
