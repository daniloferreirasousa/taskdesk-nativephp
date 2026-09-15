@extends('layouts.app')
@section('content')
<div class="bg-slate-800 p-6 rounded-lg border border-slate-700 
max-w-2xl mx-auto space-y-4">
    <h1 class="text-xl font-bold text-white">Configurações da
        Aplicação Desktop</h1>
    <p class="text-sm text-slate-400">Gerencie as opções locais
        do seu ambiente TaskDesk</p>
    <div class="border-t border-slate-700 pt-4 space-y-2">
        <p class="text-sm"><strong>Banco de Dados
                Local:</strong> SQLite</p>
        <p class="text-sm"><strong>Versão do App:</strong>
            2.0.0</p>
        <p class="text-sm"><strong>Integração com Node:</strong>
            Desabilitado (Modo Seguro)</p>
    </div>
</div>
@endsection