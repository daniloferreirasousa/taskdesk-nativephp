<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::get('/', [TarefaController::class, 'index'])->name('tarefas.index');

Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');

Route::patch('/tarefas/{tarefa}/toggle', [TarefaController::class, 'toggleConcluida'])->name('tarefas.toggle');

Route::delete('/tarefas/{tarefa}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');
