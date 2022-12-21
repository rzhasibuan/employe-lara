<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\KaryawanController;
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
Route::Post('/register',[AuthController::class,'register']);
Route::Post('/login',[AuthController::class,'login']);

Route::group(['middleware'=>['auth:sanctum']],function(){
     Route::post('/logout',[AuthController::class,'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('karyawan',KaryawanController::class);
