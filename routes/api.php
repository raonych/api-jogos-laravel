<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogoController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/',[JogoController::class,'index']); 

Route::get('/jogo/{id}',[JogoController::class,'show']); 

Route::post('/jogo',[JogoController::class,'store']); 

Route::put('/jogo/{id}',[JogoController::class,'update']); 

Route::delete('/jogo/delete/{id}',[JogoController::class,'destroy']); 
