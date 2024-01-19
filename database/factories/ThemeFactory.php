<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Theme>
 */
class ThemeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('fr_FR');
        return [
            'name' => $faker->randomElement([
                'Light',
                'Dark',
                'Garden',
                'Forest',
                'Cupcake',
                'Luxury',
            ]),
        ];
    }
}
