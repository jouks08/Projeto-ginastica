<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turma extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'nivel',
        'dias_semana',
    ];

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }

    public function presencas()
    {
        return $this->hasMany(Presenca::class);
    }
}
