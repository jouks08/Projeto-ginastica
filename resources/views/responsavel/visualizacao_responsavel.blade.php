@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">{{ $responsavel->nome }}</h3>
            <p class="text-secondary mb-0">
                Telefone: {{ $responsavel->telefone }} | E-mail: {{ $responsavel->email ?? '-' }}
            </p>
        </div>
        <a href="{{ route('responsaveis.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i> Voltar
        </a>
    </div>

    <div class="card p-4">
        <h5 class="fw-bold mb-3">Alunos ({{ $alunos->count() }})</h5>

        @forelse ($alunos as $aluno)
            <div class="border-bottom py-2">
                {{ $aluno->nome }}
                <small class="text-secondary">- Turma: {{ $aluno->turma->nome }}</small>
            </div>
        @empty
            <p class="text-secondary mb-0">Nenhum aluno vinculado.</p>
        @endforelse
    </div>
</div>
@endsection