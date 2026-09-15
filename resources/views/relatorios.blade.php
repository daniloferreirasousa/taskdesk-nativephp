@extends('layouts.app')
@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold">Relatórios do Sistema</h1>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-slate-800 p-4 rounded-lg border border-slate-700 text-center">
            <span class="block text-3xl font-bold text-indigo-400">{{ $total }}</span>
            <span class="text-xs text-slate-400">Total de
                Tarefas</span>
        </div>
        <div class="bg-slate-800 p-4 rounded-lg border border-slate-700 text-center">
            <span class="block text-3xl font-bold text-yellow-400">{{ $pendentes }}</span>
            <span class="text-xs text-slate-400">Pendentes</span>
        </div>
        <div class="bg-slate-800 p-4 rounded-lg border border-slate-700 text-center">
            <span class="block text-3xl font-bold text-emerald-400">{{ $concluidas }}</span>
            <span class="text-xs text-slate-400">Concluídas</span>
        </div>
        <div class="bg-slate-800 p-4 rounded-lg border border-slate-700 text-center">
            <span class="block text-3xl font-bold text-red-400">{{ $altaPrioridade }}</span>
            <span class="text-xs text-slate-400">Alta
                Prioridade</span>
        </div>
    </div>
    <div
        class="bg-slate-800 p-6 rounded-lg border border-slate-700 flex flex-col md:flex-row gap-4 justify-between items-center">
        <div>
            <h3 class="font-bold text-lg">Exportar Dados
                NativePHP
                Danilo de Andrade Ferreira Sousa
                Nativo</h3>
            <p class="text-sm text-slate-400">Gere um arquivo
                TXT local e abra-o automaticamente no gerenciador do
                sistema.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('relatorios.exportar') }}"
                class="bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded text-sm transition">Gerar
                e Abrir
                Arquivo</a>
            <a href="{{ route('relatorios.pasta') }}" class="bg-slate-700 hover:bg-slate-600 text-white font-semibold px-4 py-2 
rounded text-sm transition">Abrir Pasta de Relatórios</a>
        </div>
    </div>
</div>
@endsection