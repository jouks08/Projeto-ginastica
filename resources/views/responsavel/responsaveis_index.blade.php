@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="text-primary fw-bold mb-0">Responsáveis</h3>
                <p class="text-secondary small mb-0">Responsáveis cadastrados no sistema</p>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-2">
                    <i class="fa-solid fa-arrow-left me-2"></i> Painel
                </a>
                <a href="{{ route('responsaveis.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-2"></i> Novo responsável
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

        @if ($responsaveis->isEmpty())
        <p class="text-center text-secondary my-4">Nenhum responsável cadastrado ainda.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th class="text-center">Alunos</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($responsaveis as $responsavel)
                    <tr>
                        <td>
                            <a href="{{ route('responsaveis.show', $responsavel) }}" class="text-decoration-none fw-semibold">
                                {{ $responsavel->nome }}
                            </a>
                        </td>
                        <td>{{ $responsavel->telefone }}</td>
                        <td>{{ $responsavel->email ?? '-' }}</td>
                        <td class="text-center">{{ $responsavel->alunos_count }}</td>
                        <td class="text-end">
                            <a href="{{ route('responsaveis.edit', $responsavel) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('responsaveis.destroy', $responsavel) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Excluir o responsável {{ $responsavel->nome }}?')">
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

        {{ $responsaveis->links() }}
        @endif

    </div>
</div>
@endsection