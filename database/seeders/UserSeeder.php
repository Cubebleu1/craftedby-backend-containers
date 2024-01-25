<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Retrieve the regular_user role
        $regularUserRole = Role::where('name', 'regular_user')->first();

        User::factory()->count(10)->create()->each(function ($user) use ($regularUserRole) {
            if ($regularUserRole) {
                $user->roles()->attach($regularUserRole);
            }
        });
    }
}
