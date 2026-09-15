<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\RelatorioController;

Route::get('/', [TarefaController::class, 'index'])->name('tarefas.index');

Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');

Route::patch('/tarefas/{tarefa}/toggle', [TarefaController::class, 'toggleConcluida'])->name('tarefas.toggle');

Route::delete('/tarefas/{tarefa}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');

Route::get('/relatorios', [RelatorioController::class, 'index'])->name('relatorios.index');

Route::get('/relatorios/exportar', [RelatorioController::class, 'exportar'])->name('relatorios.exportar');

Route::get('/relatorios/pasta', [RelatorioController::class, 'abrirPasta'])->name('relatorios.pasta');

Route::get('/configuracoes', function () {
    return view('configuracoes');
})->name('configuracoes');

Route::get('/sobre', function () {
    return view('sobre');
})->name('sobre');