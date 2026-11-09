@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="text-primary fw-bold mb-0">Chamada</h3>
                <p class="text-secondary small mb-0">
                    {{ $turma->nome }} ({{ $turma->nivel }} - {{ $turma->dias_semana }})
                </p>
            </div>
            <a href="{{ route('turmas.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-arrow-left me-2"></i> Turmas
            </a>
        </div>

        @if (session('success'))
        <div class="alert alert-success text-center p-2">
            {{ session('success') }}
        </div>
        @endif

        {{-- escolher a data --}}
        <form action="{{ route('presencas.chamada', $turma) }}" method="GET" class="row g-2 mb-4">
            <div class="col-auto">
                <input type="date" name="data" value="{{ $data }}" max="{{ now()->toDateString() }}" class="form-control">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-primary">
                    <i class="fa-solid fa-calendar-day me-2"></i> Abrir data
                </button>
            </div>
        </form>

        @if ($alunos->isEmpty())
            <p class="text-center text-secondary my-4">Esta turma ainda não tem alunos.</p>
        @else
        <form action="{{ route('presencas.salvar', $turma) }}" method="POST">
            @csrf
            <input type="hidden" name="data" value="{{ $data }}">

            @error('data')
                <div class="alert alert-danger p-2">{{ $message }}</div>
            @enderror

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Aluno</th>
                            <th class="text-center">Presente</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alunos as $aluno)
                        <tr>
                            <td>{{ $aluno->nome }}</td>
                            <td class="text-center">
                                <input type="checkbox" class="form-check-input"
                                       name="presentes[]" value="{{ $aluno->id }}"
                                       {{ ($registradas[$aluno->id] ?? true) ? 'checked' : '' }}>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Salvar chamada
                </button>
            </div>
        </form>
        @endif

    </div>
</div>
@endsection