@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold">{{ $turma->nome }}</h3>
            <p class="text-secondary mb-0">Nível: {{ $turma->nivel }} | Dias: {{ $turma->dias_semana }}</p>
        </div>
        <a href="{{ route('turmas.index') }}" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i> Voltar
        </a>
        <a href="{{ route('relatorios.turma', $turma) }}" target="_blank" class="btn btn-outline-danger">
            <i class="fa-solid fa-file-pdf me-2"></i> Gerar PDF
        </a>

    </div>

    <div class="card p-4">
        <h5 class="fw-bold mb-3">Alunos ({{ $alunos->count() }})</h5>

        @forelse ($alunos as $aluno)
        <div class="border-bottom py-2">
            {{ $aluno->nome }}
            <small class="text-secondary">- Responsável: {{ $aluno->nome_responsavel }}</small>
        </div>
        @empty
        <p class="text-secondary mb-0">Nenhum aluno nesta turma.</p>
        @endforelse
    </div>
</div>
@endsection