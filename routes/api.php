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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::post('/product',[ProductController::class,'store']);
Route::get('/product',[ProductController::class,'show']);
Route::put('/product/{id}',[ProductController::class,'update']);
Route::delete('/product/{id}',[ProductController::class,'destroy']);

route::get('/product',[ProductController::class,'showALL'];)

Route::get('/product/{id}',[ProductController::class,'showById']);

Route::get('/product/search/product_name={product_name}',[ProductController::class,'showByName']);

Route::put('/product/{id}',[ProductController::class,'update']);

use App\Http\Controllers\UseController;
use App\Http\Controllers\UserController;

Route::post('/login',[UserController::class,'login']);

Route::middleware(['jwt-auth'])->group(fungction()){
    Route::post('/product',[ProductController::class,'store']);

    Route::get('/product',[ProductController::class,'showAll']);

    Route::get('/product/{id}',[ProductController::class,'showById']);

    Route::get('/product/search/product_name={product_name}',[ProductController::class,'showByname']);

    Route::put('/product/{id}',[ProductController::class,'update']);

    Route::delete('/product/{id}',[ProductController::class,'delete']);

    

});