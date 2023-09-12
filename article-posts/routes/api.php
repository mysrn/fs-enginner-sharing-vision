<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/article', [ArticleController::class, 'index']);
Route::post('/article', [ArticleController::class, 'store']);
Route::put('/article/{id}', [ArticleController::class, 'update']);
Route::get('/article/{id}', [ArticleController::class, 'show']);
Route::delete('/article/{id}', [ArticleController::class, 'destroy']);
Route::post('/article-trash', [ArticleController::class, 'trash']);
Route::post('/article-draft', [ArticleController::class, 'draft']);
Route::post('/article-publish', [ArticleController::class, 'publish']);

