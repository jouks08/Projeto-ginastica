<h1>Relatório geral</h1>

@foreach ($turmas as $turma)
<h3>{{ $turma->nome }} <small>({{ $turma->nivel }} - {{ $turma->dias_semana }})</small></h3>

<table>
    <thead>
        <tr>
            <th>Aluno</th>
            <th>Nascimento</th>
            <th>Responsável</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($turma->alunos as $aluno)
        <tr>
            <td>{{ $aluno->nome }}</td>
            <td>{{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}</td>
            <td>{{ $aluno->responsavel?->nome ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="3">Sem alunos.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endforeach