<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roles = ['regular_user', 'admin', 'business_user'];

        return [
            'name' => $this->faker->randomElement($roles)
        ];
    }

    /**
     * Set the role as 'admin'.
     *
     * @return Factory
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'admin',
            ];
        });
    }

    /**
     * Set the role as 'business_user'.
     *
     * @return Factory
     */
    public function businessUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'business_user',
            ];
        });
    }

    /**
     * Set the role as 'regular_user'.
     *
     * @return Factory
     */
    public function regularUser()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'regular_user',
            ];
        });
    }
}
