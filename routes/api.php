<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ProductController;
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


// Route::group(['middleware' => 'auth'], function () {
// Route::get('category', [CategoryController::class, 'index']);
// Route::post('category/store', [CategoryController::class, 'store']);
Route::resource('category', CategoryController::class);
Route::resource('product', ProductController::class);
// });
