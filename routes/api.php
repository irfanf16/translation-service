<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TranslationController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/translations', [TranslationController::class, 'store']);
    Route::put('/translations/{translation}', [TranslationController::class, 'update']);
    Route::get('/translations/{translation}', [TranslationController::class, 'show']);
    Route::get('/translations/search', [TranslationController::class, 'search']);
    Route::get('/translations/export/{locale}', [TranslationController::class, 'export']);
});
