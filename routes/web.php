<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
Route::get('/welcome', function ()
{
    return view('welcome');

});
Route::get('/register', [App\Http\Controllers\AuthenticationController::class,'show'])->middleware('guest');
Route::post('/register',[App\Http\Controllers\AuthenticationController::class,'store'])->middleware('guest');
Route::get('/logout',[App\Http\Controllers\AuthenticationController::class,'destroy'])->middleware('auth')->name('logout');
Route::get('/login', [App\Http\Controllers\SessionController::class,'show']);
// Route::post('/login',[App\Http\Controllers\SessionController::class,'store']);
