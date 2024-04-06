<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\AuthenticationController::class,'show'])->middleware('guest');
Route::post('/register',[App\Http\Controllers\AuthenticationController::class,'store'])->middleware('guest');
