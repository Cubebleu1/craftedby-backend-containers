<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ThemeSeeder::class);
        $this->call(SpecialtiesSeeder::class);
        //Create 10 businesses with associated users
        for ($i = 0; $i < 10; $i++) {
            $this->call(BusinessSeeder::class);

        }
    }
}
