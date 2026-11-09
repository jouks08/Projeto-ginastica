@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card p-4 shadow-sm">

                <div class="text-center mb-4">
                    <h3 class="text-primary fw-bold">Nova Turma</h3>
                    <p class="text-secondary small">Preencha os dados abaixo para cadastrar a turma</p>
                </div>

                <form action="{{ route('turmas.store') }}" method="POST">
                    @csrf

                    @include('turma.campos')

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('turmas.index') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-users me-2"></i> Cadastrar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection