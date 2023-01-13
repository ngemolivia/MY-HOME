<?php

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

Route::group(['middleware' => ['jwt.verify']], function () {
    Route::post('/logout', [\App\Http\Controllers\Controller::class, 'logout']);
    Route::post('/refresh', [\App\Http\Controllers\Controller::class, 'refresh']);

    Route::post('logements', [\App\Http\Controllers\LogementController::class, 'store']);
    Route::put('logements/{id}', [\App\Http\Controllers\LogementController::class, 'update']);
    Route::delete('logements/{id}', [\App\Http\Controllers\LogementController::class, 'destroy']);
    Route::put('desable/{id}', [\App\Http\Controllers\LogementController::class, 'desable']);
    Route::put('enable/{id}', [\App\Http\Controllers\LogementController::class, 'enable']);
    Route::get('logementByUser', [\App\Http\Controllers\LogementController::class, 'listByProprio']);
    Route::post('addMedia/{idLogement}', [\App\Http\Controllers\LogementController::class, 'addMedia']);
});

Route::get("logements", [\App\Http\Controllers\LogementController::class, 'index']);
Route::get("logements/{id}", [\App\Http\Controllers\LogementController::class, 'show']);

Route::post('/login', [\App\Http\Controllers\Controller::class, 'login']);
Route::post('/register', [\App\Http\Controllers\Controller::class, 'register']);
