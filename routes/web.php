<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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
    Route::resource('/usuario', UserController::class);
});
