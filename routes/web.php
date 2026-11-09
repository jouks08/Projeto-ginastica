<?php

use App\Http\Controllers\AlunoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MensalidadeController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\TurmaController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('dashboard'));

// Só para quem NÃO está logado
Route::middleware(CheckIsNotLogged::class)->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-submit', [AuthController::class, 'loginSubmit'])->name('login.submit');
});

// Só para professores logados
Route::middleware(CheckIsLogged::class)->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register-submit', [AuthController::class, 'registerSubmit'])->name('register.submit');

    Route::get('/relatorios/geral', [RelatorioController::class, 'geral'])->name('relatorios.geral');
    Route::get('/relatorios/turma/{turma}', [RelatorioController::class, 'turma'])->name('relatorios.turma');

    Route::resource('responsaveis', ResponsavelController::class)
        ->parameters(['responsaveis' => 'responsavel']);

    Route::get('/mensalidades', [MensalidadeController::class, 'index'])->name('mensalidades.index');
    Route::get('/mensalidades/nova', [MensalidadeController::class, 'create'])->name('mensalidades.create');
    Route::post('/mensalidades', [MensalidadeController::class, 'store'])->name('mensalidades.store');
    Route::patch('/mensalidades/{mensalidade}/pagar', [MensalidadeController::class, 'pagar'])->name('mensalidades.pagar');
    Route::delete('/mensalidades/{mensalidade}', [MensalidadeController::class, 'destroy'])->name('mensalidades.destroy');

    Route::get('/alunos/lixeira', [AlunoController::class, 'lixeira'])->name('alunos.lixeira');
    Route::patch('/alunos/{id}/restaurar', [AlunoController::class, 'restaurar'])->name('alunos.restaurar');

    Route::get('/turmas/{turma}/chamada', [PresencaController::class, 'chamada'])->name('presencas.chamada');
    Route::post('/turmas/{turma}/chamada', [PresencaController::class, 'salvar'])->name('presencas.salvar');

    Route::resource('alunos', AlunoController::class);
    Route::resource('turmas', TurmaController::class);
});
