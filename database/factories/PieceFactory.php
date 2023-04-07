<?php

namespace Database\Factories;

use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Piece>
 */
class PieceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom" => fake()->sentence(2),
            "reference" => fake()->unique()->isbn10(),
            "quantite" => fake()->numberBetween(0,100),
            "fournisseur_id" => Fournisseur::inRandomOrder()->first()
        ];
    }
}
