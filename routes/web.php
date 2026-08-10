<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/services', 'pages.services')->name('services.index');
Route::view('/solutions', 'pages.solutions')->name('solutions.index');
Route::view('/portfolio', 'pages.portfolio')->name('portfolio.index');
Route::view('/insights', 'pages.insights')->name('insights.index');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
