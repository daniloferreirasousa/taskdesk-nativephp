<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskDesk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="max-w-5xl mx-auto p-6">
        <header class="mb-6">
            <h1 class="text-3xl font-bold">
                TaskDesk
            </h1>

            <p class="text-gray-500">
                Gerenciador de Tarefas desktop
            </p>

            <p class="text-red-600">
                Pendentes: {{ $tarefasPendentes->count() }}
            </p>

            <p class="text-green-600">
                Concluídas: {{ $tarefasConcluidas->count() }}
            </p>

            <p class="text-semibold text-gray-700">
                Total: {{ ($tarefasConcluidas->count() + $tarefasPendentes->count()) }}
            </p>
        </header>
    
        <section class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">
                Nova Tarefa
            </h2>

            <form action="{{ route('tarefas.store') }}" method="post">
                @csrf

                <div class="mb-4">
                    <label for="titulo" class="block mb-1 font-medium">
                        Título
                    </label>

                    <input 
                        type="text"
                        id="titulo"
                        name="titulo"
                        value="{{ old('titulo') }}"
                        required
                        class="w-full border rounded px-3 py-2"
                    >
                    @error('titulo')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="descricao" class="block.mb-1.font-medium">
                        Descrição
                    </label>

                    <textarea 
                        name="descricao"
                        id="descricao"
                        rows="3"
                        class="w-full border rounded px-3 py-2"
                    >{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="prioridade" class="block.mb-1.font-medium">
                        Prioridade
                    </label>

                    <select 
                        name="prioridade" 
                        id="prioridade"
                        class="w-full border rounded px-3 py-2"
                    >
                        <option value="baixa">Baixa</option>
                        <option value="media">Média</option>
                        <option value="alta">Alta</option>
                    </select>
                    @error('prioridade')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded mt-2">
                    Adicionar Tarefa
                </button>
            </form>
        </section>

        <section class="bg-white rounded-lg shadow p-6 mb-6">
            <form action="{{ route('tarefas.index') }}" method="get">
                @csrf

                <div class="mt-4">
                    <label for="filtro" class="block.mb-1.font-medium">
                        Filtro
                    </label>

                    <select 
                        name="filtro" 
                        id="filtro"
                        class="w-full border rounded px-3 py-2"
                    >
                        <option value="todas" selected disabled>Todas</option>
                        <option value="baixa">Baixa</option>
                        <option value="media">Média</option>
                        <option value="alta">Alta</option>
                    </select>
                    @error('filtro')
                        <p class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                    <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded mt-2">
                        Filtrar
                    </button>
                </div>
            </form>
        </section>

        <section class="bg-white rounded-lg shadow p-6 mb-6">
            
            <h2 class="text-xl font-semibold mb-4">
                Tarefas Pendentes ({{ $tarefasPendentes->count() }})
            </h2>

            @if($tarefasPendentes->isEmpty())
                <p class="text-gray-500">
                    Nenhuma tarefa pendente.
                </p>
            @else
                <div class="space-y-3">
                    @foreach($tarefasPendentes as $tarefa)
                        <div class="border rounded p-4">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-semibold">
                                        {{ $tarefa->titulo }}
                                    </h3>

                                    @if($tarefa->descricao)
                                        <p class="text-gray-600 mt-1">
                                            {{ $tarefa->descricao }}
                                        </p>
                                    @endif
                                </div>

                                <span class="text-sm">
                                    {{ ucfirst($tarefa->prioridade) }}
                                </span>
                            </div>

                            <div class="mt-3 flex gap-3">
                                <form action="{{ route('tarefas.toggle', $tarefa) }}" method="post">

                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="text-green-600">
                                        Concluir
                                    </button>
                                </form>

                                <form action="{{ route('tarefas.destroy', $tarefa) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 ">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        @if($tarefasConcluidas->isNotEmpty())
            <section class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-semibold mb-4">
                    Tarefas Concluídas
                </h2>

                <div class="spacey-y-3">
                    @foreach($tarefasConcluidas as $tarefa)
                        <div class="border rounded p-4">
                            <div class="flex justify-between">
                                <span class="line-through text-gray-500">
                                    {{ $tarefa->titulo }}
                                </span>

                                <form action="{{ route('tarefas.toggle', $tarefa) }}" method="post">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="text-blue-600">
                                        Reabrir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</body>
</html>