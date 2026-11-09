<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Responsavel;
use App\Models\Turma;

class MainController extends Controller
{
    public function dashboard()
    {
        $totalTurmas = Turma::count();
        $totalAlunos = Aluno::count();
        $totalResponsaveis = Responsavel::count();


        return view('dashboard', compact('totalTurmas', 'totalAlunos', 'totalResponsaveis'));


        
    }
}