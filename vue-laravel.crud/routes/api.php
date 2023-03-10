<?php

use App\Http\Controllers\ProductController;
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
Route::resource('product', ProductController::class);
// Route::get('product', [ProductController::class, 'index']);
// Route::post('product/save', [ProductController::class, 'store']);
// Route::put('product/update/{id}', [ProductController::class, 'update']);
// Route::delete('product/delete/{id}', [ProductController::class, 'destroy']);
