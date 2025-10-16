<?php

use App\Http\Controllers\CRUDController;
use Illuminate\Support\Facades\Route;

Route::get('/players', [CRUDController::class, 'getAllPlayers']);
Route::get('/players/{id}', [CRUDController::class, 'getPlayerById']);
Route::post('/players', [CRUDController::class, 'newPlayer']);
Route::put('/players/{id}', [CRUDController::class, 'updatePlayer']);
Route::delete('/players/{id}', [CRUDController::class, 'deletePlayer']);
