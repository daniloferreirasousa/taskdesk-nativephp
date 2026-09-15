<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tarefa;

class TarefaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tarefa::create([
            'titulo'        => 'Estudar Arquitetura NativePHP',
            'descricao'     => 'Revisar Integraçãp do NativeServiceProvider com facades de desktop',
            'prioridade'    => 'alta',
            'categoria'     => 'Estudos',
            'concluida'     => false,
        ]);

        Tarefa::create([
            'titulo'        => 'Desenvolver TaskDesk 2.0',
            'descricao'     => 'Implementar gerador de Ralatórios e atalhos globais',
            'prioridade'    => 'media',
            'categoria'     => 'Trabalho',
            'concluida'     => false,
        ]);
    }
}
