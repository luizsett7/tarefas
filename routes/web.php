<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TarefaController;

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
    return view('welcome');
});

Auth::routes();

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('nova_tarefa', [TarefaController::class, 'nova_tarefa'])->name('nova_tarefa');

Route::get('lista_tarefa', [TarefaController::class, 'index'])->name('lista_tarefa');

Route::post('modal_tarefa', [TarefaController::class, 'modal_tarefa'])->name('modal_tarefa');

Route::get('tarefa_colaborador/{id}', [TarefaController::class, 'tarefa_colaborador'])->name('tarefa_colaborador');

Route::post('salvar_tarefa', [TarefaController::class, 'create'])->name('salvar_tarefa');

