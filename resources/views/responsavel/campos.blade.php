<div class="mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text" name="nome" id="nome"
           class="form-control @error('nome') is-invalid @enderror"
           value="{{ old('nome', $responsavel->nome ?? '') }}" required>
    @error('nome')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="tel" name="telefone" id="telefone"
           class="form-control @error('telefone') is-invalid @enderror"
           value="{{ old('telefone', $responsavel->telefone ?? '') }}" required>
    @error('telefone')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">E-mail <small class="text-secondary">(opcional)</small></label>
    <input type="email" name="email" id="email"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $responsavel->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>