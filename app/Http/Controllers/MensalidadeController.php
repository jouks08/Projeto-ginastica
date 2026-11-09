<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Mensalidade;
use Illuminate\Http\Request;

class MensalidadeController extends Controller
{
    public function index()
    {
        $mensalidades = Mensalidade::with('aluno.turma')
            ->orderBy('data_vencimento', 'desc')
            ->paginate(10);

        return view('mensalidade.mensalidades_index', compact('mensalidades'));
    }

    public function create()
    {
        $alunos = Aluno::orderBy('nome')->get();
        return view('mensalidade.cadastro_mensalidade', compact('alunos'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'aluno_id'        => 'required|exists:alunos,id',
            'valor'           => 'required|numeric|min:0',
            'mes_referencia'  => 'required|date_format:Y-m',
            'data_vencimento' => 'required|date',
        ]);

        $existe = Mensalidade::where('aluno_id', $dados['aluno_id'])
            ->where('mes_referencia', $dados['mes_referencia'])
            ->exists();

        if ($existe) {
            return back()->withInput()->withErrors([
                'mes_referencia' => 'Esse aluno já tem mensalidade nesse mês.',
            ]);
        }

        Mensalidade::create($dados);

        return redirect()->route('mensalidades.index')
            ->with('success', 'Mensalidade cadastrada.');
    }

    public function pagar(Mensalidade $mensalidade)
    {
        $mensalidade->update(['data_pagamento' => now()]);

        return back()->with('success', 'Pagamento registrado.');
    }

    public function destroy(Mensalidade $mensalidade)
    {
        $mensalidade->delete();

        return back()->with('success', 'Mensalidade removida.');
    }
}
