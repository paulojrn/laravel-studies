<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/series', [SeriesController::class, 'index'])->name('list_series');
Route::get('/series/create', [SeriesController::class, 'create'])->name('create_serie_form');
Route::post('/series/create', [SeriesController::class, 'store'])->name('create_serie');
Route::delete('/series/delete/{id}', [SeriesController::class, 'destroy'])->name('delete_serie');
