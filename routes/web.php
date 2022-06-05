<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContaController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
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

// renomeando o padrão do laravel para pt-br
Route::resourceVerbs([
    'create' => 'novo',
    'edit' => 'editar',
]);

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/entrar', [LoginController::class, 'autenticate'])->name('entrar');
Route::get('/sair', [LoginController::class, 'logout'])->name('sair');

Route::middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dash');
    Route::resource('/usuario', UsuarioController::class);
    Route::resource('/funcionario', FuncionarioController::class);
    Route::resource('/cliente', ClienteController::class);
    Route::resource('/produto', ProdutoController::class);
    Route::resource('/conta', ContaController::class);
    Route::resource('/venda', VendaController::class);

    Route::get('/relatorio-vendas', [VendaController::class, 'relatorio'])->name('venda.relatorio');
    Route::any('/buscaRelatorio', [VendaController::class, 'buscaRelatorio'])->name('venda.buscaRelatorio');
    Route::get('/userSeed', [UsuarioController::class, 'seed'])->name('usuario.seed');
    Route::get('/funcionarioSeed', [FuncionarioController::class, 'seed'])->name('funcionario.seed');
    Route::get('/clienteSeed', [ClienteController::class, 'seed'])->name('cliente.seed');
    Route::get('/produtoSeed', [ProdutoController::class, 'seed'])->name('produto.seed');
});
