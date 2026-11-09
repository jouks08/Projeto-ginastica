<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Aluno extends Model
{

    use HasFactory, SoftDeletes;

    protected $fillable = [
        'turma_id',
        'nome',
        'data_nascimento',
        'responsavel_id',
    ];

    protected $casts = [
        'data_nascimento' => 'date',
        'data_matricula' => 'date',
        'ativo' => 'boolean',
    ];

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function responsavel()
    {
        return $this->belongsTo(Responsavel::class);
    }

    public function mensalidades()
    {
        return $this->hasMany(Mensalidade::class);
    }

    public function presencas()
    {
        return $this->hasMany(Presenca::class);
    }
}
