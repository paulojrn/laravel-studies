<?php

use App\Http\Controllers\SerieController;
use Illuminate\Http\Request;
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

// Route::get("/", "SerieController@index");

Route::get('/', function (Request $request) {
    return (new SerieController())->index($request);
});

Route::get('/serie/create', function () {
    return (new SerieController())->create();
});

Route::post('/serie/create', function (Request $request) {
    (new SerieController())->store($request);
    return redirect("/");
});