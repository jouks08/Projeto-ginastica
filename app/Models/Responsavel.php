<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Responsavel extends Model
{
    use HasFactory;

    protected $table = 'responsaveis';

    protected $fillable = ['nome', 'telefone', 'email'];

    public function alunos()
    {
        return $this->hasMany(Aluno::class);
    }
}
