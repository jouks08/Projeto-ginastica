@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="text-primary fw-bold mb-0">{{ $turma->nome }}</h3>
                <p class="text-secondary small mb-0">
                    {{ $turma->nivel }} · {{ $turma->dias_semana }}
                </p>
            </div>
            <div>
                <a href="{{ route('turmas.index') }}" class="btn btn-outline-secondary me-2">
                    <i class="fa-solid fa-arrow-left me-2"></i> Turmas
                </a>
                <a href="{{ route('turmas.edit', $turma) }}" class="btn btn-outline-primary">
                    <i class="fa-solid fa-pen me-2"></i> Editar turma
                </a>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success text-center p-2">
            {{ session('success') }}
        </div>
        @endif

        <h5 class="fw-bold mb-3">
            Alunos da turma
            <span class="badge bg-primary ms-1">{{ $turma->alunos->count() }}</span>
        </h5>

        @if ($turma->alunos->isEmpty())
            <p class="text-center text-secondary my-4">Esta turma ainda não tem alunos.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nascimento</th>
                        <th>Responsável</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turma->alunos->sortBy('nome') as $aluno)
                    <tr>
                        <td>{{ $aluno->nome }}</td>
                        <td>{{ $aluno->data_nascimento->format('d/m/Y') }}</td>
                        <td>{{ $aluno->nome_responsavel ?? '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('alunos.edit', $aluno) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <div class="mt-3">
            <a href="{{ route('alunos.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-user-plus me-2"></i> Novo aluno
            </a>
        </div>

    </div>
</div>
@endsection