@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="text-primary fw-bold mb-0">Alunos</h3>
                <p class="text-secondary small mb-0">Alunos cadastrados no sistema</p>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-2">
                    <i class="fa-solid fa-arrow-left me-2"></i> Painel
                </a>
                <a href="{{ route('alunos.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-user-plus me-2"></i> Novo aluno
                </a>
                <a href="{{ route('alunos.lixeira') }}" class="btn btn-outline-secondary me-2">
                    <i class="fa-solid fa-trash-can-arrow-up me-2"></i> Lixeira
                </a>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success text-center p-2">
            {{ session('success') }}
        </div>
        @endif

        @if ($alunos->isEmpty())
        <p class="text-center text-secondary my-4">Nenhum aluno cadastrado ainda.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Turma</th>
                        <th>Nascimento</th>
                        <th>Responsável</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                    <tr>
                        <td>{{ $aluno->nome }}</td>
                        <td>{{ $aluno->turma->nome }}</td>
                        <td>{{ $aluno->data_nascimento->format('d/m/Y') }}</td>
                        <td>{{ $aluno->nome_responsavel ?? '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('alunos.destroy', $aluno) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Excluir o aluno {{ $aluno->nome }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $alunos->links() }}
        @endif

    </div>
</div>
@endsection