# Sistema de Gestão para Escola de Ginástica

Projeto final desenvolvido em **Laravel** para gerenciar turmas, alunos, responsáveis, mensalidades e presenças de uma escola de ginástica.

> **Autor:** [seu nome]
> **Curso / Instituição:** [curso e escola]
> **Ano:** 2026

---

## Sobre o projeto

O sistema permite que os professores (operadores do sistema) façam login e administrem o dia a dia da escola: cadastrar turmas e alunos, registrar responsáveis, controlar mensalidades e marcar presenças, além de gerar relatórios em PDF.

## Funcionalidades

- Login de professores (autenticação manual por sessão, com middlewares `CheckIsLogged` e `CheckIsNotLogged`)
- Dashboard com acesso rápido às listagens de turmas e alunos
- CRUD de **turmas** (nome, nível, dias da semana)
- CRUD de **alunos** (nome, turma, data de nascimento, nome do responsável)
- Ao clicar em uma turma, exibe a lista dos alunos dela
- Cadastro de **responsáveis**
- Controle de **mensalidades** (vinculadas ao aluno)
- Registro de **presenças**
- Geração de **relatórios em PDF**
- **Soft deletes** (exclusão lógica, permitindo recuperar registros)
- [Segunda funcionalidade escolhida: a definir]

## Tecnologias utilizadas

- PHP / Laravel 12
- MySQL [confirmar o banco usado]
- Bootstrap e Font Awesome
- barryvdh/laravel-dompdf (relatórios em PDF)

## Modelo de dados

| Tabela | Descrição |
|---|---|
| `users` | Professores que operam o sistema |
| `turmas` | Turmas da escola (nome, nível, dias da semana) |
| `alunos` | Alunos (pertencem a uma turma) |
| `responsaveis` | Responsáveis pelos alunos |
| `mensalidades` | Mensalidades, ligadas ao aluno (`aluno_id`) |
| `presencas` | Registro de presença dos alunos |

**Relacionamentos principais**

- Uma turma tem vários alunos (`Turma hasMany Aluno`)
- Cada aluno pertence a uma turma (`Aluno belongsTo Turma`)
- Cada mensalidade pertence a um aluno

## Requisitos

- PHP 8.2 ou superior
- Composer
- MySQL
- Node.js e NPM (se for compilar assets)

## Como instalar e rodar

```bash
# 1. Clonar o repositório
git clone [url-do-repositorio]
cd [nome-da-pasta]

# 2. Instalar as dependências
composer install

# 3. Configurar o ambiente
cp .env.example .env
php artisan key:generate
```

Edite o arquivo `.env` com os dados do seu banco de dados:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

```bash
# 4. Criar as tabelas e popular o banco
php artisan migrate --seed

# 5. Iniciar o servidor
php artisan serve
```

Acesse em: http://localhost:8000

## Acesso ao sistema

O seeder cria um usuário inicial para o primeiro acesso:

- **E-mail:** [email do seeder]
- **Senha:** [senha do seeder]

## Estrutura do projeto

```
app/
 ├── Http/
 │   ├── Controllers/    # Controllers (validação feita diretamente neles)
 │   └── Middleware/     # CheckIsLogged e CheckIsNotLogged
 └── Models/             # User, Turma, Aluno, Responsavel, Mensalidade, Presenca
database/
 ├── migrations/
 └── seeders/
resources/views/
 └── layouts/main_layout.blade.php
```

## Licença

Projeto desenvolvido para fins acadêmicos.
