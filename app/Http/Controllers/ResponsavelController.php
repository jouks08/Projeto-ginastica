<?php

namespace App\Http\Controllers;

use App\Models\Responsavel;
use Illuminate\Http\Request;

class ResponsavelController extends Controller
{
    public function index()
    {
        $responsaveis = Responsavel::withCount('alunos')
            ->orderBy('nome')
            ->paginate(10);

        return view('responsavel.responsaveis_index', compact('responsaveis'));
    }

    public function create()
    {
        return view('responsavel.cadastro_responsavel');
    }

    public function store(Request $request)
    {
        $dados = $request->validate($this->regras());

        Responsavel::create($dados);

        return redirect()
            ->route('responsaveis.index')
            ->with('success', 'Responsável cadastrado com sucesso!');
    }

    public function show(Responsavel $responsavel)
    {
        $alunos = $responsavel->alunos()->with('turma')->orderBy('nome')->get();

        return view('responsavel.show', compact('responsavel', 'alunos'));
    }

    public function edit(Responsavel $responsavel)
    {
        return view('responsavel.editar_responsavel', compact('responsavel'));
    }

    public function update(Request $request, Responsavel $responsavel)
    {
        $dados = $request->validate($this->regras());

        $responsavel->update($dados);

        return redirect()
            ->route('responsaveis.index')
            ->with('success', 'Responsável atualizado com sucesso!');
    }

    public function destroy(Responsavel $responsavel)
    {
        if ($responsavel->alunos()->exists()) {
            return redirect()
                ->route('responsaveis.index')
                ->withErrors(['responsavel' => 'Não é possível excluir: este responsável tem alunos vinculados.']);
        }

        $responsavel->delete();

        return redirect()
            ->route('responsaveis.index')
            ->with('success', 'Responsável removido com sucesso!');
    }

    private function regras(): array
    {
        return [
            'nome'     => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'max:20'],
            'email'    => ['nullable', 'email', 'max:255'],
        ];
    }
}