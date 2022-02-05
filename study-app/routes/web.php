<?php

use App\Http\Controllers\EntrarController;
use App\Http\Controllers\EpisodioController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\TemporadaController;
use App\Http\Requests\SerieFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

$middlewareAuth = "autenticador";

Route::get("/", SerieController::class . "@index");

// Route::get('/', function (Request $request) {
//     return (new SerieController())->index($request);
// })->name("index");

Route::get('/serie/create', function () {
    return (new SerieController())->create();
})->name("form_create")->middleware($middlewareAuth);

Route::post('/serie', function (SerieFormRequest $request) {
    (new SerieController())->store($request);
    return redirect("/");
})->name("do_create")->middleware($middlewareAuth);

Route::delete('/serie/{id}', function (Request $request) {
    (new SerieController())->destroy($request);
    return redirect()->route("index");
})->name("do_delete")->middleware($middlewareAuth);

Route::get('/serie/{id}/temporadas', function ($id) {
    return (new TemporadaController())->index($id);
})->name("show_temporadas");

Route::post('/serie/{id}/edit-name', function ($id, Request $request) {
    return (new SerieController())->edit($id, $request);
})->middleware($middlewareAuth);

Route::get('/temporada/{id}/episodios', function ($id, Request $request) {
    return (new EpisodioController())->index($id, $request);
});

Route::post('/temporada/{id}/episodios/assistir', function ($id, Request $request) {
    return (new EpisodioController())->assistir($id, $request);
})->middleware($middlewareAuth);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("/entrar", EntrarController::class . "@index");
Route::post("/entrar", EntrarController::class . "@entrar");

Route::get("/registrar", RegistroController::class . "@create");
Route::post("/registrar", RegistroController::class . "@store");
Route::get("/sair", function () {
    Auth::logout();
    return redirect("/entrar");
});