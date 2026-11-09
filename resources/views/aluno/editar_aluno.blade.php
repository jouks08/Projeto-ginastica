@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card p-4 shadow-sm">

                <div class="text-center mb-4">
                    <h3 class="text-primary fw-bold">Editar Aluno</h3>
                    <p class="text-secondary small">Altere os dados e salve</p>
                </div>

                <form action="{{ route('alunos.update', $aluno) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('aluno.campos')

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('alunos.index') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Salvar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection