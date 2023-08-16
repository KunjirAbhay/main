<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    LoginController,
    UserController
};

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
Route::post('login' ,[ LoginController::class , 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    
});
Route::post('addUser' ,[ UserController::class , 'addUser']);
Route::get('getAllUser' ,[ UserController::class , 'getALLUser']);
Route::post('getUser' ,[ UserController::class , 'getUser']);




