<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #222;
        }

        h1 {
            font-size: 18px;
            margin-bottom: 2px;
        }

        .sub {
            color: #666;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        .rodape {
            margin-top: 20px;
            font-size: 10px;
            color: #888;
        }
    </style>
</head>

<body>
    <h1>Turma: {{ $turma->nome }}</h1>
    <div class="sub">Nível: {{ $turma->nivel }} | Dias: {{ $turma->dias_semana }}</div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Aluno</th>
                <th>Nascimento</th>
                <th>Responsável</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alunos as $aluno)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $aluno->nome }}</td>
                <td>{{ \Carbon\Carbon::parse($aluno->data_nascimento)->format('d/m/Y') }}</td>
                <td>{{ $aluno->responsavel?->nome ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Nenhum aluno nesta turma.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="rodape">
        Total: {{ $alunos->count() }} aluno(s) | Gerado em {{ now()->format('d/m/Y H:i') }}
    </div>
</body>

</html>