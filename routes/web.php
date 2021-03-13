<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', function () {
    return redirect("lista_tarefa/".Auth::user()->id);     
});

Auth::routes();

Route::get('nova_tarefa', [TarefaController::class, 'nova_tarefa'])->name('nova_tarefa');

Route::get('editar_tarefa/{id}/{id_user}', [TarefaController::class, 'editar_tarefa'])->name('editar_tarefa');

Route::get('editar_cadastro', [HomeController::class, 'editar_cadastro'])->name('editar_cadastro');

Route::post('update_cadastro', [HomeController::class, 'update_cadastro'])->name('update_cadastro');

Route::post('update/{id}/{id_user}', [TarefaController::class, 'update'])->name('update');

Route::get('lista_tarefa/{id}', [TarefaController::class, 'index'])->name('lista_tarefa');

Route::post('modal_tarefa', [TarefaController::class, 'modal_tarefa'])->name('modal_tarefa');

Route::get('tarefa_colaborador/{id}', [TarefaController::class, 'tarefa_colaborador'])->name('tarefa_colaborador');

Route::post('salvar_tarefa', [TarefaController::class, 'create'])->name('salvar_tarefa');

Route::post('deletar', [TarefaController::class, 'deletar'])->name('deletar');

Route::get('recuperar', [HomeController::class, 'recuperar'])->name('recuperar');

Route::post('enviar_email', [HomeController::class, 'enviar_email'])->name('enviar_email');

Route::get('retorno_email', [HomeController::class, 'retorno_email'])->name('retorno_email');

Route::post('alterar_status', [TarefaController::class, 'alterar_status'])->name('alterar_status');
