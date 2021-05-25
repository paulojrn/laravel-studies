<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{SeriesController, SeasonController, EpisodeController, LoginController, RegisterController};
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [SeriesController::class, 'index'])->name('list_series');
Route::get('/series/create', [SeriesController::class, 'create'])
    ->name('create_serie_form')
    ->middleware('auth2');
Route::post('/series/create', [SeriesController::class, 'store'])
    ->name('create_serie')
    ->middleware('auth2');
Route::delete('/series/delete/{id}', [SeriesController::class, 'destroy'])
    ->name('delete_serie')
    ->middleware('auth2');
Route::get('/series/{serieId}/seasons', [SeasonController::class, 'index'])->name('list-seasons');
Route::post('/series/{serieId}/edit', [SeriesController::class, 'edit'])
    ->name('serie-edit')
    ->middleware('auth2');;
Route::get('/seasons/{season}/episodes', [EpisodeController::class, 'index'])->name('list-episodes');
Route::post('/seasons/{season}/episodes/watch', [EpisodeController::class, 'watch'])
    ->name('watch-episodes')
    ->middleware('auth2');

Route::get('/login', [LoginController::class, 'index'])->name('login'); // need name login because larave use it in background
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/exit', function() {
    Auth::logout();
    return redirect('login');
});
