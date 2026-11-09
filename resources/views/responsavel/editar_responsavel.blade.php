@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
                <h3 class="text-primary fw-bold mb-4">Editar responsável</h3>

                <form action="{{ route('responsaveis.update', $responsavel) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @include('responsavel.campos')

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('responsaveis.index') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-arrow-left me-2"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Atualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection