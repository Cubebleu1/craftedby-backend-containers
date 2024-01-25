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
    }
}
