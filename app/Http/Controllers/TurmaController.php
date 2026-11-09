<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        $turmas = Turma::withCount('alunos')->orderBy('nome')->paginate(10);

        return view('turma.turmas_index', compact('turmas'));
    }
    
    public function create()
    {
        return view('turma.cadastro_turma');
    }

    public function store(Request $request)
    {
        $dados = $request->validate($this->regras());

        Turma::create($dados);

        return redirect()
            ->route('turmas.index')
            ->with('success', 'Turma cadastrada com sucesso!');
    }

    public function show(Turma $turma)
    {
        $alunos = $turma->alunos()->orderBy('nome')->get();

        return view('aluno.mostrar_alunos', compact('turma', 'alunos'));
    }

    public function edit(Turma $turma)
    {
        return view('turma.editar_turma', compact('turma'));
    }

    public function update(Request $request, Turma $turma)
    {
        $dados = $request->validate($this->regras());

        $turma->update($dados);

        return redirect()
            ->route('turmas.index')
            ->with('success', 'Turma atualizada com sucesso!');
    }

    public function destroy(Turma $turma)
    {
        $turma->delete();

        return redirect()
            ->route('turmas.index')
            ->with('success', 'Turma removida com sucesso!');
    }

    private function regras(): array
    {
        return [
            'nome'        => ['required', 'string', 'max:255'],
            'nivel'       => ['required', 'string', 'max:50'],
            'dias_semana' => ['required', 'string', 'max:100'],
        ];
    }
}
