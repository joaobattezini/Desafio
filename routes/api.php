<?php

use App\Http\Controllers\Api\V1\ClientsController;
use App\Http\Controllers\Api\V1\ItemsController;
use App\Http\Controllers\Api\V1\MenusController;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\TablesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/v1/clients', [ClientsController::class, 'index']);
Route::post('/v1/clients', [ClientsController::class, 'create']);


Route::get('/v1/tables', [TablesController::class, 'index']);
Route::post('/v1/tables', [TablesController::class, 'create']);

Route::get('/v1/menus/{id}', [MenusController::class, 'show']);
Route::get('/v1/menus', [MenusController::class, 'index']);
Route::post('/v1/menus', [MenusController::class, 'create']);
Route::put('/v1/menus/{id}', [MenusController::class, 'update']);
Route::delete('/v1/menus/{id}', [MenusController::class, 'delete']);


Route::get('/v1/items/{id}', [ItemsController::class, 'show']);
Route::get('/v1/items', [ItemsController::class, 'index']);
Route::post('/v1/items', [ItemsController::class, 'create']);
Route::put('/v1/items/{id}', [ItemsController::class, 'update']);
Route::delete('/v1/items/{id}', [ItemsController::class, 'delete']);

Route::get('/v1/orders', [OrdersController::class, 'index']);
Route::post('/v1/orders', [OrdersController::class, 'create']);