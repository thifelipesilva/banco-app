<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransacoesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::post('usuario', [AuthController::class, 'registrar']);
Route::post('login', [AuthController::class, 'logar'])->name('login');

Route::post('logout', [AuthController::class, 'deslogar']);



Route::put('depositar/{id}', [TransacoesController::class, 'depositar'])->middleware('auth:sanctum');
Route::put('transferir/{id}/{conta_destino}', [TransacoesController::class, 'transferir'])->middleware('auth:sanctum');
