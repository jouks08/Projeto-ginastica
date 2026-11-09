<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presenca extends Model
{
    use HasFactory;

    protected $table = 'presencas';

    protected $fillable = ['aluno_id', 'turma_id', 'data', 'presente'];

    protected $casts = [
        'data'     => 'date',
        'presente' => 'boolean',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class)->withTrashed();
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
}
