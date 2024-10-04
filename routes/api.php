<?php

use App\Http\Controllers\Api\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
    // Route::get('/reviewers', [ReviewController::class, 'index']);
    Route::get('/talk-proposals/{id}/reviews', [ReviewController::class, 'show']);
    Route::get('/talk-proposals/stats', [ReviewController::class, 'stats']);
});

Route::get('/reviewers', [ReviewController::class, 'index']);

// You Can add more api route here
