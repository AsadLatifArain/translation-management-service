<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TranslationController;
use App\Http\Controllers\Auth\AuthController;
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('login', [AuthController::class, 'login'])->name('login');

Route::post('signup', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('translations', [TranslationController::class, 'index']);
    Route::post('translation/store', [TranslationController::class, 'store']);
    Route::post('translation/update/{id}', [TranslationController::class, 'update']);
    Route::get('translation/export/{locale?}', [TranslationController::class, 'exportTranslations']);
    Route::delete('translations/{id}', [TranslationController::class, 'destroy']);

    Route::post('logout', [AuthController::class, 'logout']);
});
