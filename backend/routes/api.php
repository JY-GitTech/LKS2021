<?php

use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\TokenController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ChartController;
use App\Http\Controllers\User\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix("auth")->group(function(){
    Route::post("/register", [AuthController::class, 'register']);
    Route::post("/login", [AuthController::class, 'login']);
    Route::middleware('checktoken')->group(function(){
        Route::get('/logout', [AuthController::class, 'logout']);
    });
});

Route::middleware("checktoken")->group(function(){
    Route::apiResource("/kebunku", ProdukController::class);
    Route::apiResource('/admin_news', NewsController::class);
    Route::get('/token', [TokenController::class, 'gettoken']);
    //chart
    Route::get('/chart', [ChartController::class, 'index']);
    Route::post('/chart/{id}', [ChartController::class, 'store']);
    Route::delete('/chart/{id}', [ChartController::class, 'delete']);

    //customer
    Route::get('/produk', [CustomerController::class, 'produk']);
    Route::get('/produk/{id}', [CustomerController::class, 'produkid']);
    Route::get('/news', [CustomerController::class, 'news']);
    Route::get('/userchart', [CustomerController::class, 'userchart']);
    Route::delete('/deletechart', [CustomerController::class, 'deletechart']);
});
