<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve the regular_user role
        $adminRole = Role::where('name', 'admin')->first();

        // Create an admin user using the 'admin' state/method and attach the 'admin' role
        User::factory()->admin()->create()->each(function ($user) use ($adminRole) {
            $user->roles()->attach($adminRole);
        });

        // Retrieve the regular_user role
        $regularUser = Role::where('name', 'regular_user')->first();

        // Create a regular user using the 'regularUser' state/method and attach the 'regular_user' role
        User::factory()->regularUser()->create()->each(function ($user) use ($regularUser) {
            $user->roles()->attach($regularUser);
        });
    }
}
