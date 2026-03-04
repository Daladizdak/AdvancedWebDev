<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;

Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::resource('heroes', HeroController::class);