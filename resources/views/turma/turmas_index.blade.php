@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="text-primary fw-bold mb-0">Turmas</h3>
                <p class="text-secondary small mb-0">Turmas cadastradas no sistema</p>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-2">
                    <i class="fa-solid fa-arrow-left me-2"></i> Painel
                </a>
                <a href="{{ route('turmas.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-2"></i> Nova turma
                </a>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success text-center p-2">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger text-center p-2">
            {{ $errors->first() }}
        </div>
        @endif

        <a href="{{ route('relatorios.geral') }}" target="_blank" class="btn btn-outline-danger">
            <i class="fa-solid fa-file-pdf me-2"></i> Relatório geral
        </a>

        @if ($turmas->isEmpty())
        <p class="text-center text-secondary my-4">Nenhuma turma cadastrada ainda.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Nível</th>
                        <th>Dias</th>
                        <th class="text-center">Alunos</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($turmas as $turma)
                    <tr>
                        <td>
                            <a href="{{ route('turmas.show', $turma) }}" class="text-decoration-none fw-semibold">
                                {{ $turma->nome }}
                            </a>
                        </td>
                        <td>{{ $turma->nivel }}</td>
                        <td>{{ $turma->dias_semana }}</td>
                        <td class="text-center">{{ $turma->alunos_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('presencas.chamada', $turma) }}" class="btn btn-sm btn-outline-success" title="Fazer chamada">
                                <i class="fa-solid fa-clipboard-check"></i>
                            </a>
                            <a href="{{ route('turmas.edit', $turma) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('turmas.destroy', $turma) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Excluir a turma {{ $turma->nome }}? Os alunos dela também serão excluídos.')">
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

        {{ $turmas->links() }}
        @endif

    </div>
</div>
@endsection