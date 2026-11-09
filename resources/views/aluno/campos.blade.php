<div class="mb-3">
    <label for="turma_id" class="form-label">Turma</label>
    <select name="turma_id" id="turma_id"
            class="form-select @error('turma_id') is-invalid @enderror" required>
        <option value="">Selecione a turma</option>
        @foreach ($turmas as $turma)
            <option value="{{ $turma->id }}"
                {{ old('turma_id', $aluno->turma_id ?? '') == $turma->id ? 'selected' : '' }}>
                {{ $turma->nome }}
            </option>
        @endforeach
    </select>
    @error('turma_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" name="nome" id="nome"
           class="form-control @error('nome') is-invalid @enderror"
           value="{{ old('nome', $aluno->nome ?? '') }}" required>
    @error('nome')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="data_nascimento" class="form-label">Data de nascimento</label>
    <input type="date" name="data_nascimento" id="data_nascimento"
           class="form-control @error('data_nascimento') is-invalid @enderror"
           value="{{ old('data_nascimento', isset($aluno) ? $aluno->data_nascimento->format('Y-m-d') : '') }}"
           required>
    @error('data_nascimento')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="responsavel_id" class="form-label">Responsável</label>
    <select name="responsavel_id" id="responsavel_id"
            class="form-select @error('responsavel_id') is-invalid @enderror" required>
        <option value="">Selecione o responsável</option>
        @foreach ($responsaveis as $responsavel)
            <option value="{{ $responsavel->id }}"
                {{ old('responsavel_id', $aluno->responsavel_id ?? '') == $responsavel->id ? 'selected' : '' }}>
                {{ $responsavel->nome }}
            </option>
        @endforeach
    </select>
    @error('responsavel_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>