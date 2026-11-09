<?php

namespace Database\Factories;

use App\Models\Turma;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Turma>
 */
class TurmaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'        => fake()->unique()->randomElement([
                'Borboletas',
                'Estrelas',
                'Golfinhos',
                'Águias',
                'Pegasus',
                'Aurora',
            ]),
            'nivel'       => fake()->randomElement(['Iniciante', 'Intermediário', 'Avançado']),
            'dias_semana' => fake()->randomElement(['Seg/Qua', 'Ter/Qui', 'Sáb']),
        ];
    }
}
