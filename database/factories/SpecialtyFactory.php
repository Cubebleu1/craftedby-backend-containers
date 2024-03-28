<?php

namespace Database\Factories;

use App\Models\Specialty;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Specialty>
 */
class SpecialtyFactory extends Factory
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
                'Menuiserie',
                'Couturerie',
                'Verrier',
                'Broderie',
                'Céramiste',
                'Ebénisterie',
                'Ferronnage',
                'Horlogerie',
                'Maroquinerie',
                'Joaillerie',
                'Tapissier',
                'Sellier',
                'Vannier',
                'Poterie',
                'Autre'
            ]),
        ];
    }
}
