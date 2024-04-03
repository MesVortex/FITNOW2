<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Progress>
 */
class ProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        return [
            'userID' => $user->id,
            'weight' => fake()->randomNumber(),
            'height' => fake()->randomNumber(),
            'waist_line' => fake()->randomNumber(),
            'bicep_thickness' => fake()->randomNumber(),
            'pec_width' => fake()->randomNumber(),
            'calve_thickness' => fake()->randomNumber(),
        ];
    }
}
