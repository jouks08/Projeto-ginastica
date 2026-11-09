<?php

namespace Database\Factories;

use App\Models\Aluno;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome'            => fake()->name(),
            'data_nascimento' => fake()->dateTimeBetween('-17 years', '-5 years')->format('Y-m-d'),
        ];
    }
}
