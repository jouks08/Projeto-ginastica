@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">

    @include('top_bar')

    <div class="text-center mb-5">
        <h3 class="text-primary fw-bold">Painel de Atividades</h3>
        <p class="text-secondary small">Bem-vindo, {{ session('user.username') }}</p>
    </div>

    <div class="row justify-content-center g-4">

        <div class="col-md-5 col-lg-4">
            <div class="card p-4 shadow-sm text-center h-100">
                <i class="fa-solid fa-users fa-2x text-primary mb-3"></i>
                <h5 class="fw-bold">Turmas</h5>
                <p class="display-6 mb-3">{{ $totalTurmas }}</p>
                <div class="d-grid gap-2 mt-auto">
                    <a href="{{ route('turmas.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-list me-2"></i> Ver turmas
                    </a>
                    <a href="{{ route('turmas.create') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-plus me-2"></i> Nova turma
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-lg-4">
            <div class="card p-4 shadow-sm text-center h-100">
                <i class="fa-solid fa-child-reaching fa-2x text-primary mb-3"></i>
                <h5 class="fw-bold">Alunos</h5>
                <p class="display-6 mb-3">{{ $totalAlunos }}</p>
                <div class="d-grid gap-2 mt-auto">
                    <a href="{{ route('alunos.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-list me-2"></i> Ver alunos
                    </a>
                    <a href="{{ route('alunos.create') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-user-plus me-2"></i> Novo aluno
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-lg-4">
            <div class="card p-4 shadow-sm text-center h-100">
                <i class="fa-solid fa-user-group fa-2x text-primary mb-3"></i>
                <h5 class="fw-bold">Responsáveis</h5>
                <p class="display-6 mb-3">{{ $totalResponsaveis }}</p>
                <div class="d-grid gap-2 mt-auto">
                    <a href="{{ route('responsaveis.index') }}" class="btn btn-primary">
                        <i class="fa-solid fa-list me-2"></i> Ver responsáveis
                    </a>
                    <a href="{{ route('responsaveis.create') }}" class="btn btn-outline-primary">
                        <i class="fa-solid fa-user-plus me-2"></i> Novo responsável
                    </a>
                </div>
            </div>
        </div>
        <a href="{{ route('mensalidades.index') }}" class="btn btn-outline-primary">
            <i class="fa-solid fa-money-bill"></i> Mensalidades
        </a>

    </div>
</div>
@endsection