<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Club>
 */
class ClubFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         $clubs = range('A', 'Z');
         $clubName = 'Club ' . $this->faker->randomElement($clubs);
 
         return [
             'name' => $clubName,
         ];
    }
}
