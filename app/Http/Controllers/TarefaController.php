<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use App\Http\Requests\TarefaRequest;
use Native\Desktop\Facades\Notification;

class TarefaController extends Controller
{
    public function index(Request $request)
    {
        $query = Tarefa::query();

        // Pesquisa por título
        if ($request->filled('busca')) {
            $query->where('titulo', 'like', "%{$request->busca}%");
        }

        // Filtro por prioridade
        if ($request->filled('prioridade')) {
            $query->where('prioridade', 'like', "%{$request->prioridade}$");
        }

        // Filtro por status
        if ($request->filled('status')) {
            $query->where('concluida', false);
        } elseif ($request->status === 'concluidas') {
            $query->where('concluida', true);
        }

        $tarefas = $query->orderBy('created_at', 'desc')->get();
        $categorias = Tarefa::select('categoria')->whereNotNull('categoria')->distinct()->pluck('categoria');

        return view('tarefas.index', compact(
            'tarefas',
            'categorias'
        ));
    }


    public function store(TarefaRequest $request)
    {
        $tarefa = Tarefa::create($request->validated());

        Notification::new()
            ->title('TaskDesk')
            ->message("Nova tarefa '{$tarefa['titulo']}' criada com sucesso!")
            ->show();
        
        return redirect()->route('tarefas.index');
    }


    public function toggleConcluida(Tarefa $tarefa)
    {
        $tarefa->update([
            'concluida' => !$tarefa->concluida
        ]);

        return redirect()->back();
    }

    
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();

        Notification::new()
            ->title('TaskDesk')
            ->message('Tarefa removida com sucesso.')
            ->show();

        return redirect()->back();
    }
}
