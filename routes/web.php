<?php

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

Route::get('/login', function () {
    return view('admin.admin');
});
//Route::get('/', function () {
//    return view('layout.main');
//});

Route::middleware('auth:api')->group(function () {
    Route::prefix('produto')->group(function () {
        Route::get('/listar', function () {
            return view('produto.listar');
        });
        Route::get('/cadastrar', function () {
            return view('produto.cadastrar');
        });
    });
});
