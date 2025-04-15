<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogoController;
use App\Http\Controllers\FilmesController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/jogos',[JogoController::class,'index']); 

Route::get('/jogo/{id}',[JogoController::class,'show']); 

Route::post('/jogo',[JogoController::class,'store']); 

Route::put('/jogo/{id}',[JogoController::class,'update']); 

Route::delete('/jogo/delete/{id}',[JogoController::class,'destroy']); 


Route::get('/filmes',[FilmesController::class,'index']); 

Route::get('/filmes/{id}',[FilmesController::class,'show']); 

Route::post('/filmes',[FilmesController::class,'store']); 

Route::put('/filmes/{id}',[FilmesController::class,'update']); 

Route::delete('/filmes/delete/{id}',[FilmesController::class,'destroy']); 
