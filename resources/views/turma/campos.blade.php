<div class="mb-3">
    <label for="nome" class="form-label">Nome da turma</label>
    <input type="text" name="nome" id="nome"
           class="form-control @error('nome') is-invalid @enderror"
           value="{{ old('nome', $turma->nome ?? '') }}" required>
    @error('nome')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="nivel" class="form-label">Nível</label>
    <select name="nivel" id="nivel"
            class="form-select @error('nivel') is-invalid @enderror" required>
        <option value="">Selecione o nível</option>
        @foreach (['Iniciante', 'Intermediário', 'Avançado'] as $nivel)
            <option value="{{ $nivel }}"
                {{ old('nivel', $turma->nivel ?? '') == $nivel ? 'selected' : '' }}>
                {{ $nivel }}
            </option>
        @endforeach
    </select>
    @error('nivel')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="dias_semana" class="form-label">Dias da semana</label>
    <input type="text" name="dias_semana" id="dias_semana"
           class="form-control @error('dias_semana') is-invalid @enderror"
           placeholder="Ex.: Seg/Qua"
           value="{{ old('dias_semana', $turma->dias_semana ?? '') }}" required>
    @error('dias_semana')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>