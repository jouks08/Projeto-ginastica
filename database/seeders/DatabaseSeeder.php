<?php

namespace Database\Seeders;

use App\Models\Aluno;
use App\Models\Mensalidade;
use App\Models\Presenca;
use App\Models\Responsavel;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'nome' => 'teste',
            'email' => 'teste@teste',
            'password' => '123456',
        ]);

        $turmas       = Turma::factory(4)->create();
        $responsaveis = Responsavel::factory(10)->create();

        $alunos = collect();
        for ($i = 0; $i < 20; $i++) {
            $alunos->push(Aluno::factory()->create([
                'turma_id'       => $turmas->random()->id,
                'responsavel_id' => $responsaveis->random()->id,
            ]));
        }

        foreach ($alunos as $aluno) {
            foreach (range(3, 0) as $mesesAtras) {
                $mes        = now()->subMonths($mesesAtras);
                $vencimento = $mes->copy()->day(10);
                $paga       = $mesesAtras > 0 && fake()->boolean(70);

                Mensalidade::create([
                    'aluno_id'        => $aluno->id,
                    'valor'           => fake()->randomElement([150, 180, 200]),
                    'mes_referencia'  => $mes->format('Y-m'),
                    'data_vencimento' => $vencimento,
                    'data_pagamento'  => $paga ? $vencimento->copy()->subDays(rand(0, 5)) : null,
                ]);
            }

            foreach (range(1, 4) as $semana) {
                Presenca::create([
                    'aluno_id' => $aluno->id,
                    'turma_id' => $aluno->turma_id,
                    'data'     => now()->subWeeks($semana)->toDateString(),
                    'presente' => fake()->boolean(80),
                ]);
            }
        }
    }
}
