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

// Basic API route example
Route::get('/test', function () {
    return response()->json(['message' => 'API is Working!']);
});

// Resource controller route
Route::apiResource('products', \App\Http\Controllers\ProductController::class);

// Grouped routes with middleware
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Api\DashboardController::class, 'index']);
    Route::post('/profile', [\App\Http\Controllers\Api\ProfileController::class, 'update']);
});

// Route with parameters
Route::get('/users/{id}', function ($id) {
    return \App\Models\User::findOrFail($id);
});

// Versioned API routes
Route::prefix('v1')->group(function () {
    Route::apiResource('posts', \App\Http\Controllers\Api\V1\PostController::class);
});
