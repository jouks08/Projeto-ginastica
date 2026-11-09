<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioController extends Controller
{
    public function geral()
    {
        $turmas = Turma::with(['alunos' => fn ($q) => $q->orderBy('nome')])
            ->orderBy('nome')
            ->get();

        $pdf = Pdf::loadView('relatorios.geral', compact('turmas'));

        return $pdf->stream('relatorio-geral.pdf');
    }

    public function turma(Turma $turma)
    {
        $alunos = $turma->alunos()->orderBy('nome')->get();

        $pdf = Pdf::loadView('relatorios.turma', compact('turma', 'alunos'));

        return $pdf->stream("turma-{$turma->id}.pdf");
    }
}