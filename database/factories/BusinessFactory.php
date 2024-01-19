<?php

namespace Database\Factories;

use App\Models\Business;
use App\Models\Craft;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Business>
 */
class BusinessFactory extends Factory
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
//            'user_id' =>
            'name' => $faker->company,
            'address' => $faker->streetAddress,
            'postal_code' => $faker->postcode,
            'city' => $faker->city,
            'email' => $faker->unique()->safeEmail,
            'phone_number' => $faker->phoneNumber,
            'siret' => '1234567890',
//            'craft_id' => '',
            'website' => $faker->domainName,
            'biography' => 'yoyo',
            'history' => 'yolo',
            'theme_id' => '1',
        ];
    }
}
