<?php

use App\Http\Controllers\Request\ReceivedRequestController;
use App\Http\Controllers\Request\SentRequestController;
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
Route::middleware(['auth:api'])->group(function () {
    Route::post('/accept', [ReceivedRequestController::class, 'store']);
    Route::apiResource('/', ReceivedRequestController::class);
});
