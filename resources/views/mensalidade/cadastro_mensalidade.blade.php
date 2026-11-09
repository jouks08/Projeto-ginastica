@extends('layouts.main_layout')

@section('content')
<div class="container">
    <h1>Nova mensalidade</h1>

    <form action="{{ route('mensalidades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Aluno</label>
            <select name="aluno_id" class="form-select @error('aluno_id') is-invalid @enderror">
                <option value="">Selecione...</option>
                @foreach ($alunos as $aluno)
                    <option value="{{ $aluno->id }}" @selected(old('aluno_id') == $aluno->id)>
                        {{ $aluno->nome }}
                    </option>
                @endforeach
            </select>
            @error('aluno_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Mês de referência</label>
            <input type="month" name="mes_referencia" value="{{ old('mes_referencia') }}"
                   class="form-control @error('mes_referencia') is-invalid @enderror">
            @error('mes_referencia') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Valor</label>
            <input type="number" step="0.01" name="valor" value="{{ old('valor') }}"
                   class="form-control @error('valor') is-invalid @enderror">
            @error('valor') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Vencimento</label>
            <input type="date" name="data_vencimento" value="{{ old('data_vencimento') }}"
                   class="form-control @error('data_vencimento') is-invalid @enderror">
            @error('data_vencimento') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button class="btn btn-primary">Salvar</button>
        <a href="{{ route('mensalidades.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection