<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::post('/api/clients/store', [ClientController::class, 'store'])->name('clients.store');
Route::delete('/api/clients/delete/{email}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::get('/api/clients/get/{client}', [ClientController::class, 'show'])->name('clients.show');
Route::put('/api/clients/update/{email}', [ClientController::class, 'update'])->name('clients.update');
