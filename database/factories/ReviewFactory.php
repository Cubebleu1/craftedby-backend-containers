<?php

namespace Database\Factories;

use App\Models\Review;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
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
            'rating' => rand(3, 5),
            'comment'=> $faker->text(50),
        ];
    }
}
