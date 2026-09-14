<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Http\Requests\TarefaRequest;
use Native\Desktop\Facades\Notification;

class TarefaController extends Controller
{
    public function index()
    {
        $tarefasPendentes = Tarefa::where('concluida', false)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $tarefasConcluidas = Tarefa::where('concluida', true)
            ->orderBy('concluida_em', 'desc')
            ->get();

        return view('tarefas.index', compact(
            'tarefasPendentes',
            'tarefasConcluidas'
        ));
    }


    public function store(TarefaRequest $request)
    {
        $tarefa = Tarefa::create($request->validated());

        Notification::new()
            ->title('TaskDesk - Nova Tarefa')
            ->message("A tarefa '{$tarefa['titulo']}' foi adicionada.")
            ->show();
        
        return redirect()->route('tarefas.index');
    }


    public function toggleConcluida(Tarefa $tarefa)
    {
        $tarefa->concluida = !$tarefa->concluida;

        $tarefa->concluida_em = $tarefa->concluida ? now() : null;

        $tarefa->save();

        if ($tarefa->concluida) {
            Notification::new()
                ->title('Parabéns!')
                ->message("Você concluiu: '{$tarefa->titulo}'")
                ->show();
        }

        return redirect()->route('tarefas.index');
    }

    
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        return redirect()->route('tarefas.index');
    }
}
