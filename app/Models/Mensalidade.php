<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mensalidade extends Model
{

    use HasFactory;

    protected $fillable = ['aluno_id', 'valor', 'mes_referencia', 'data_vencimento', 'data_pagamento'];

    protected $casts = [
        'data_vencimento' => 'date',
        'data_pagamento'  => 'date',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class)->withTrashed();
    }

    public function getStatusAttribute(): string
    {
        if ($this->data_pagamento) return 'Paga';
        return $this->data_vencimento->isPast() ? 'Atrasada' : 'Pendente';
    }
}
