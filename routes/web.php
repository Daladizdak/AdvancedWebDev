<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\CompetitionController;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::resource('heroes', HeroController::class);

Route::get('/workshop', [WorkshopController::class, 'index'])->name('workshop.index');
Route::post('/workshop', [WorkshopController::class, 'store'])->name('workshop.store');
Route::put('/workshop/{hero}', [WorkshopController::class, 'update'])->name('workshop.update');
Route::delete('/workshop/{hero}', [WorkshopController::class, 'destroy'])->name('workshop.destroy');

Route::get('/competition', [CompetitionController::class, 'index'])->name('competition.index');