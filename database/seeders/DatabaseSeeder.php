<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Delete all previous made fake images if any
        File::cleanDirectory(public_path('images/products'));
        //Businesses and associated tables (will create user for each business)
        $this->call(CraftSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(SpecialtiesSeeder::class);
        //Create 10 businesses with associated users
        for ($i = 0; $i < 10; $i++) {
            $this->call(BusinessSeeder::class);
        }
        //Products and associated tables
        $this->call(CategorySeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(MaterialSeeder::class);
        //Create 50 products
        for ($i = 0; $i < 15; $i++) {
            $this->call(ProductSeeder::class);
        }
    }
}
