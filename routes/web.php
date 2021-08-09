<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');
Route::get('logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'logout'])->name('go.logout');


Route::post('/cadastro', [\App\Http\Controllers\UsuarioController::class, 'cadastrar']);


Route::middleware('auth')->group(function () {
    Route::get('/home', function (){
        return view('welcome');
    });
    Route::get('/', function (){
        return view('welcome');
    });
    Route::prefix('user')->group(function () {
        Route::get('/', [\App\Http\Controllers\UsuarioController::class, 'usuario']);
    });

    Route::prefix('produto')->group(function () {
        Route::get('/cadastrar', [\App\Http\Controllers\ProdutoController::class, 'cadastrar'])->name('produto.cadastrar');
        Route::post('/cadastrar', [\App\Http\Controllers\ProdutoController::class, 'salvar'])->name('produto.salvar');
        Route::get('/listar', [\App\Http\Controllers\ProdutoController::class, 'listar'])->name('produto.listar');
    });

    Route::prefix('categoria')->group(function () {
        Route::get('/cadastrar', [\App\Http\Controllers\CategoriaController::class, 'cadastrar'])->name('categoria.cadastrar');
        Route::post('/cadastrar', [\App\Http\Controllers\CategoriaController::class, 'salvar'])->name('categoria.salvar');
        Route::get('/listar', [\App\Http\Controllers\CategoriaController::class, 'listar'])->name('categoria.listar');
    });
});
