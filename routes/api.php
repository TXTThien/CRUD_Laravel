<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRUDController;

Route::get('/players', [CRUDController::class, 'getAllPlayers']);
Route::get('/players/{id}', [CRUDController::class, 'getPlayerById']);
Route::post('/players', [CRUDController::class, 'newPlayer']);
Route::put('/players/{id}', [CRUDController::class, 'updatePlayer']);
Route::delete('/players/{id}', [CRUDController::class, 'deletePlayer']);
