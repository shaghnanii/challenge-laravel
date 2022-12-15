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
Route::middleware(['auth:api'])->group(function () {
    Route::get('/', [SuggestionController::class, 'index']);
});
