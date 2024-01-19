<?php

namespace Database\Factories;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
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
            'order_number' => $faker->randomNumber(8, true),
            'total_without_tax' => $totalWoTax = $faker->numberBetween(30, 200),
            'tax_amount' => $tax = $totalWoTax*0.2,
            'total_tax_included' => $totalWoTax+$tax,
            'payment_status' => $faker->boolean,
            ];
    }
}
