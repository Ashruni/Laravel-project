<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
Route::get('/', function ()
{
    return view('welcome');

});
Route::get('/reg', [App\Http\Controllers\AuthenticationController::class,'show'])->middleware('guest');
Route::post('/register',[App\Http\Controllers\AuthenticationController::class,'store'])->middleware('guest');
Route::post('/logout',[App\Http\Controllers\AuthenticationController::class,'destroy'])->middleware('auth')->name('logout');
Route::get('/login', [App\Http\Controllers\SessionController::class,'show'])->middleware('guest');
Route::post('/login',[App\Http\Controllers\SessionController::class,'check'])->middleware('guest')->name('login');;
