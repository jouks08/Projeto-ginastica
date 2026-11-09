<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Responsavel;
use App\Models\Turma;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::with(['turma', 'responsavel'])->orderBy('nome')->paginate(10);

        return view('aluno.alunos_index', compact('alunos'));
    }

    public function create()
    {
        $turmas = Turma::orderBy('nome')->get();
        $responsaveis = Responsavel::orderBy('nome')->get();

        return view('aluno.cadastro_aluno', compact('turmas', 'responsaveis'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate($this->regras());

        Aluno::create($dados);

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Aluno cadastrado com sucesso!');
    }

    public function show(Aluno $aluno)
    {
        $aluno->load(['turma', 'responsavel']);

        return view('aluno.show', compact('aluno'));
    }

    public function edit(Aluno $aluno)
    {
        $turmas = Turma::orderBy('nome')->get();
        $responsaveis = Responsavel::orderBy('nome')->get();

        return view('aluno.editar_aluno', compact('aluno', 'turmas', 'responsaveis'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $dados = $request->validate($this->regras());

        $aluno->update($dados);

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Aluno atualizado com sucesso!');
    }

    public function delete(Aluno $aluno)
    {
        $aluno->delete();

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Aluno enviado para a lixeira!');
    }

    private function regras(): array
    {
        return [
            'turma_id'        => ['required', 'exists:turmas,id'],
            'responsavel_id'  => ['required', 'exists:responsaveis,id'],
            'nome'            => ['required', 'string', 'max:255'],
            'data_nascimento' => ['required', 'date', 'before:today'],
        ];
    }

    public function lixeira()
    {
        $alunos = Aluno::onlyTrashed()
            ->with('turma')
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('aluno.lixeira', compact('alunos'));
    }

    public function restaurar($id)
    {
        $aluno = Aluno::onlyTrashed()->findOrFail($id);
        $aluno->restore();

        return redirect()->route('alunos.lixeira')
            ->with('success', "Aluno {$aluno->nome} restaurado.");
    }
}
