@extends('layouts.main_layout')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="text-primary fw-bold mb-0">Mensalidades</h3>
                <p class="text-secondary small mb-0">Mensalidades cadastradas no sistema</p>
            </div>
            <div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary me-2">
                    <i class="fa-solid fa-arrow-left me-2"></i> Painel
                </a>
                <a href="{{ route('mensalidades.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus me-2"></i> Nova mensalidade
                </a>
            </div>
        </div>

        @if (session('success'))
        <div class="alert alert-success text-center p-2">
            {{ session('success') }}
        </div>
        @endif

        @if ($mensalidades->isEmpty())
            <p class="text-center text-secondary my-4">Nenhuma mensalidade cadastrada ainda.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Turma</th>
                        <th>Mês</th>
                        <th>Valor</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mensalidades as $mensalidade)
                    <tr>
                        <td>{{ $mensalidade->aluno->nome }}</td>
                        <td>{{ $mensalidade->aluno->turma->nome ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::createFromFormat('Y-m', $mensalidade->mes_referencia)->format('m/Y') }}</td>
                        <td>R$ {{ number_format($mensalidade->valor, 2, ',', '.') }}</td>
                        <td>{{ $mensalidade->data_vencimento->format('d/m/Y') }}</td>
                        <td>
                            @if ($mensalidade->status === 'Paga')
                                <span class="badge bg-success">Paga</span>
                            @elseif ($mensalidade->status === 'Atrasada')
                                <span class="badge bg-danger">Atrasada</span>
                            @else
                                <span class="badge bg-warning text-dark">Pendente</span>
                            @endif
                        </td>
                        <td class="text-end">
                            @unless ($mensalidade->data_pagamento)
                            <form action="{{ route('mensalidades.pagar', $mensalidade) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Marcar a mensalidade de {{ $mensalidade->aluno->nome }} como paga?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-sm btn-outline-success" title="Marcar como paga">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                            </form>
                            @endunless
                            <form action="{{ route('mensalidades.destroy', $mensalidade) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Excluir a mensalidade de {{ $mensalidade->aluno->nome }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $mensalidades->links() }}
        @endif

    </div>
</div>
@endsection