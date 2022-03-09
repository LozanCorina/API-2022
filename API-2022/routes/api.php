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
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('blog', \App\Http\Controllers\Api\BlogController::class)->middleware('auth:sanctum');
    Route::post('blog/vote',[\App\Http\Controllers\Api\BlogController::class, 'vote']);
});
Route::get('top-categories',[\App\Http\Controllers\Api\BlogController::class, 'topCategories']);
Route::get('all-articles',[\App\Http\Controllers\Api\BlogController::class, 'allArticles']);

