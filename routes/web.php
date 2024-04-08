<?php
use App\Http\Controllers;
use Illuminate\Support\Facades\Route;
Route::get('/welcome', function ()
{
    return view('welcome');

});

Route::get('/reg', [App\Http\Controllers\AuthenticationController::class,'show'])->middleware('guest');
Route::post('/register',[App\Http\Controllers\AuthenticationController::class,'store'])->middleware('guest');
Route::post('/logout',[App\Http\Controllers\AuthenticationController::class,'destroy'])->middleware('auth')->name('logout');
Route::get('/login', [App\Http\Controllers\SessionController::class,'show'])->middleware('guest');
Route::post('/login',[App\Http\Controllers\SessionController::class,'check'])->middleware('guest')->name('login');
Route::get('/home',[App\Http\Controllers\DashboardController::class,'home']);
Route::get('/deposits',[App\Http\Controllers\DashboardController::class,'display']);
Route::post('/deposits',[App\Http\Controllers\DashboardController::class,'store']);
Route::get('/withdraw',[App\Http\Controllers\DashboardController::class,'show']);
Route::post('/withdraw',[App\Http\Controllers\DashboardController::class,'withdraw']);
Route::get('/transfer',[App\Http\Controllers\DashboardController::class,'shows']);
Route::post('/transfer',[App\Http\Controllers\DashboardController::class,'save']);
Route::get('/statements',[App\Http\Controllers\DashboardController::class,'displays']);


