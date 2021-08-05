<?php

use App\Http\Controllers\{
    CategoriaController,
    ProdutoController,
    UsuarioController,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/cadastro', [UsuarioController::class, 'cadastrar']);


Route::middleware('auth:api')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UsuarioController::class, 'usuario']);
    });

    Route::prefix('produto')->group(function () {
        Route::post('/cadastrar', [ProdutoController::class, 'cadastrar']);
        Route::get('/listar', [ProdutoController::class, 'listar']);
    });

    Route::prefix('categoria')->group(function () {
        Route::post('/cadastrar', [CategoriaController::class, 'cadastrar']);
        Route::get('/listar', [CategoriaController::class, 'listar']);
    });

});
