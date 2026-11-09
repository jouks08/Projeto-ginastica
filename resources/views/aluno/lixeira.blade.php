@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="text-primary fw-bold mb-0">Alunos excluídos</h3>
                <p class="text-secondary small mb-0">Alunos removidos que podem ser restaurados</p>
            </div>
            <a href="{{ route('alunos.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i> Alunos
            </a>
        </div>

        @if (session('success'))
        <div class="alert alert-success text-center p-2">
            {{ session('success') }}
        </div>
        @endif

        @if ($alunos->isEmpty())
            <p class="text-center text-secondary my-4">Nenhum aluno na lixeira.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Turma</th>
                        <th>Excluído em</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alunos as $aluno)
                    <tr>
                        <td>{{ $aluno->nome }}</td>
                        <td>{{ $aluno->turma->nome ?? '—' }}</td>
                        <td>{{ $aluno->deleted_at->format('d/m/Y H:i') }}</td>
                        <td class="text-end">
                            <form action="{{ route('alunos.restaurar', $aluno->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Restaurar o aluno {{ $aluno->nome }}?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-success" title="Restaurar">
                                    <i class="fa-solid fa-rotate-left"></i>
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