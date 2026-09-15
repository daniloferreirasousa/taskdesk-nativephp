<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarefa;
use Illuminate\Support\Facades\File;
use Native\Desktop\Facades\Shell;

class RelatorioController extends Controller
{
    public function index()
    {
        $total = Tarefa::count();
        $pendentes = Tarefa::where('concluida', false)->count();
        $concluidas = Tarefa::where('concluida', true)->count();
        $altaPrioridade = Tarefa::where('prioridade', 'alta')
                                ->where('concluida', false)->count();

        return view('relatorios', compact('total', 'pendentes', 'concluidas', 'altaPrioridade'));
    }

    public function exportar()
    {
        $pasta = storage_path('app/relatorios');

        if (!File::exists($pasta)) {
            File::makeDirectory($pasta, 0755, true);
        }

        $caminhoArquivo = "{$pasta}/relatorio_tarefas.txt";

        $tarefas = Tarefa::all();
        $conteudo = "=== RELATÓRIO DO TASKDESK ===\n";
        $conteudo .= "Gerado em: " . now()->format('d/m/Y H:i:s') . "\n\n";

        foreach ($tarefas as $t) {
            $status = $t->concluida ? '[CONCLUÍDA]' : '[PENDENTE]';

            $conteudo .= "{$status} {$t->titulo} | Categoria: {$t->categoria} | Prioridade: {$t->prioridade}\n";
        }

        File::put($caminhoArquivo, $conteudo);

        // Abre o arquivo no aplicativo padrão do SO
        Shell::openFile($caminhoArquivo);

        return redirect()->back()->with('sucesso', 'Relatório gerado com sucesso!');
    }

    public function abrirPasta()
    {
        $pasta = storage_path('app/relatorios');

        if (!File::exists($pasta)) {
            File::makeDirectory($pasta, 0755, true);
        }

        // Abre a pasta no gerenciador de aruivos do SO
        Shell::showInFolder($pasta);

        return redirect()->back();
    }
}
