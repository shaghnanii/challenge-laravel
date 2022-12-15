<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Connection\ConnectionController;
use App\Http\Controllers\Connection\ConnectionInCommonController;
use App\Http\Controllers\Request\ReceivedRequestController;
use App\Http\Controllers\Request\SentRequestController;
use App\Http\Controllers\Suggestion\SuggestionController;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:api'])->group(function () {
    Route::get("/user", [AuthController::class, 'me']);
    Route::get("/logout", [AuthController::class, 'logout']);
//    Route::apiResource('/suggestions', SuggestionController::class);

//    Route::delete('/remove-connections/{id}', [ConnectionController::class, 'destroy']);
//    Route::get("/common-connections", [ConnectionInCommonController::class, 'index']);
//    Route::apiResource('/connections', ConnectionController::class);

//    Route::apiResource('/sent-requests', SentRequestController::class);
//    Route::delete('/withdraw-requests/{id}', [SentRequestController::class, 'destroy']);

//    Route::post('/accept-requests', [ReceivedRequestController::class, 'store']);
//    Route::apiResource('/received-requests', ReceivedRequestController::class);
});
