<?php

namespace App\Http\Controllers;

use App\Models\Presenca;
use App\Models\Turma;
use Illuminate\Http\Request;

class PresencaController extends Controller
{
    public function chamada(Request $request, Turma $turma)
    {
        $data = $request->query('data', now()->toDateString());

        $alunos = $turma->alunos()->orderBy('nome')->get();

        // presenças já registradas nessa data, indexadas por aluno_id
        $registradas = Presenca::where('turma_id', $turma->id)
            ->whereDate('data', $data)
            ->pluck('presente', 'aluno_id');

        return view('presenca.chamada', compact('turma', 'alunos', 'data', 'registradas'));
    }

    public function salvar(Request $request, Turma $turma)
    {
        $request->validate([
            'data' => 'required|date|before_or_equal:today',
        ]);

        $presentes = $request->input('presentes', []);

        foreach ($turma->alunos as $aluno) {
            Presenca::updateOrCreate(
                ['aluno_id' => $aluno->id, 'data' => $request->data],
                ['turma_id' => $turma->id, 'presente' => in_array($aluno->id, $presentes)]
            );
        }

        return redirect()
            ->route('presencas.chamada', ['turma' => $turma, 'data' => $request->data])
            ->with('success', 'Chamada salva.');
    }
}
