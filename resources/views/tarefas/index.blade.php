@extends('layouts.app')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <!-- Form de Cadastro -->
    <div class="bg-slate-800 p-5 rounded-lg border border-slate-700 h-fit">
        <h2 class="text-lg font-bold mb-4 text-indigo-400">Nova
            Tarefa</h2>
        <form action="{{ route('tarefas.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold 
uppercase text-slate-400 mb-1">Título</label>
                <input type="text" name="titulo" required class="w-full bg-slate-900 border border-slate-700 rounded p-2 
text-sm text-white focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-semibold 
uppercase text-slate-400 mb-1">Categoria</label>
                <input type="text" name="categoria" NativePHP Danilo de Andrade Ferreira Sousa 18
                    placeholder="Ex: Trabalho, Estudos" class="w-full bg-slate-900 
border border-slate-700 rounded p-2 text-sm text-white 
focus:outline-none focus:border-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-semibold 
uppercase text-slate-400 mb-1">Prioridade</label>
                <select name="prioridade" class="w-full bg-slate-900 border border-slate-700 rounded p-2 text-sm text-white 
focus:outline-none focus:border-indigo-500">
                    <option value="baixa">Baixa</option>
                    <option value="media" selected>Média</option>
                    <option value="alta">Alta</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold 
uppercase text-slate-400 mb-1">Descrição</label>
                <textarea name="descricao" rows="3" class="w-full bg-slate-900 border border-slate-700 rounded p-2 text-sm 
text-white focus:outline-none focus:border-indigo-500"></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 
hover:bg-indigo-500 text-white font-semibold py-2 rounded 
transition">Salvar Tarefa</button>
        </form>
    </div>
    <!-- Lista de Tarefas e Filtros -->
    <div class="md:col-span-2 space-y-4">
        <!-- Filtros -->
        <form method="GET" action="{{ route('tarefas.index') }}" class="bg-slate-800 p-4 rounded-lg border border-slate-700 flex 
flex-wrap gap-3">
            <input type="text" name="busca" value="{{ 
request('busca') }}" placeholder="Pesquisar..."
                class="bg-slate-900 border border-slate-700 rounded px-3 py-1.5 text-sm text-white flex-1">
            <select name="status" class="bg-slate-900 border 
border-slate-700 rounded px-3 py-1.5 text-sm text-white">
                NativePHP
                Danilo de Andrade Ferreira Sousa 19
                <option value="">Todos os Status</option>
                <option value="pendentes" {{ request('status') 
== 'pendentes' ? 'selected' : '' }}>Pendentes</option>
                <option value="concluidas" {{ request('status') 
== 'concluidas' ? 'selected' : '' }}>Concluídas</option>
            </select>
            <select name="prioridade" class="bg-slate-900 border 
border-slate-700 rounded px-3 py-1.5 text-sm text-white">
                <option value="">Todas Prioridades</option>
                <option value="baixa" {{ request('prioridade') 
== 'baixa' ? 'selected' : '' }}>Baixa</option>
                <option value="media" {{ request('prioridade') 
== 'media' ? 'selected' : '' }}>Média</option>
                <option value="alta" {{ request('prioridade') == 
'alta' ? 'selected' : '' }}>Alta</option>
            </select>
            <button type="submit" class="bg-slate-700 hover:bg-slate-600 px-4 py-1.5 rounded text-sm">Filtrar</button>
        </form>
        <!-- Lista -->
        <div class="space-y-2">
            @forelse($tarefas as $tarefa)
            <div class="bg-slate-800 p-4 rounded-lg border 
border-slate-700 flex justify-between items-center">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="font-bold text-base {{ 
$tarefa->concluida ? 'line-through text-slate-500' : 'text-white' }}">{{ $tarefa->titulo }}</span>
                        @if($tarefa->categoria)
                        <span class="text-xs bg-slate-700 text-indigo-300 px-2 py-0.5 rounded">{{ $tarefa->categoria 
}}</span>
                        @endif
                        <span class="text-xs px-2 py-0.5 
rounded {{ $tarefa->prioridade == 'alta' ? 'bg-red-900/50 text-red-300' : ($tarefa->prioridade == 'media' ? 'bg-yellow-900/50 
text-yellow-300' : 'bg-green-900/50 text-green-300') }}">
                            {{ ucfirst($tarefa->prioridade) 
}}
                        </span>
                        NativePHP
                        Danilo de Andrade Ferreira Sousa 20
                    </div>
                    @if($tarefa->descricao)
                    <p class="text-sm text-slate-400">{{
$tarefa->descricao }}</p>
                    @endif
                </div>
                <div class="flex gap-2">
                    <form action="{{ route('tarefas.toggle', 
$tarefa) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="text-xs 
bg-slate-700 hover:bg-slate-600 px-3 py-1.5 rounded">
                            {{ $tarefa->concluida ? 
'Reabrir' : 'Concluir' }}
                        </button>
                    </form>
                    <form action="{{ 
route('tarefas.destroy', $tarefa) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs 
bg-red-900/40 hover:bg-red-800/60 text-red-300 px-3 py-1.5 
rounded">Excluir</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="bg-slate-800 p-8 text-center text-slate-500 rounded-lg border border-slate-700">
                Nenhuma tarefa encontrada.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection