<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Indicate that the model's 'email' and 'password' should be set for an admin user.
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => 'admin@admin.com',
                'password' => bcrypt('password'),
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('fr_FR');
        return [
            'last_name' => $faker->lastName,
            'first_name' => $faker->firstName,
            'address' => $faker->streetAddress,
            'postal_code' => $faker->postcode,
            'city' => $faker->city,
            'phone_number' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => static::$password??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
