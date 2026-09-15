<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskDesk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-900 text-slate-100 min-h-screen flex flex-col font-sans">
    <nav class="bg-slate-800 border-b border-slate-700 px-6 py-4 
flex justify-between items-center">
        <div class="flex items-center gap-3">
            <span class="text-xl font-bold bg-gradient-to-r 
from-indigo-400 to-sky-400 bg-clip-text text-transparent">TaskDesk</span>
        </div>
        <div class="flex gap-4 text-sm font-medium">
            <a href="{{ route('tarefas.index') }}" class="hover:text-indigo-400 transition">Tarefas</a>
            <a href="{{ route('relatorios.index') }}" NativePHP Danilo de Andrade Ferreira Sousa 17
                class="hover:text-indigo-400 transition">Relatórios</a>
            <a href="{{ route('configuracoes') }}" class="hover:text-indigo-400 transition">Configurações</a>
            <a href="{{ route('sobre') }}" class="hover:text-indigo-400 transition">Sobre</a>
        </div>
    </nav>
    <main class="flex-1 p-6 max-w-6xl w-full mx-auto">
        @yield('content')
    </main>
</body>

</html>