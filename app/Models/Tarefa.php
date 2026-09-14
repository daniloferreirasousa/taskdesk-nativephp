<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarefa extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'prioridade',
        'concluida',
        'concluida_em',
    ];

    protected $casts = [
        'concluida' => 'boolean',
        'concluida_em'  => 'datetime',
    ];
}
