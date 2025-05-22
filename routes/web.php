<?php

use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KotobaController;
use App\Http\Controllers\KanjiController;

Route::get('/', [QuizController::class, 'index'])->name('quiz.index');

Route::prefix('/dashboard')->group(function () {
    Route::resource('kotoba', KotobaController::class);
    Route::resource('kanji', KanjiController::class);
});


