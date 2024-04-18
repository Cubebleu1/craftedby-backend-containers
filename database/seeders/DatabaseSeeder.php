<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Keep in this order, else seeding will fail
     */
    public function run(): void
    {
        //Delete all previous made fake images if any
        File::cleanDirectory(public_path('images/products'));

        //Roles (admin, business_owner, regular_user
        $this->call(RoleSeeder::class);

        //Create an admin
        $this->call(AdminSeeder::class);

        //10 new users with regular_user role only
        $this->call(UserSeeder::class);

        //Businesses and associated tables (will create user for each business)
        $this->call(CraftSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(SpecialtiesSeeder::class);
        //Create X businesses with associated users
        for ($i = 0; $i < 10; $i++) {
            $this->call(BusinessSeeder::class);
        }
        //Products and associated tables
        $this->call(CategorySeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(MaterialSeeder::class);
        //Create X products
        for ($i = 0; $i < 100; $i++) {
            $this->call(ProductSeeder::class);
        //Create X orders for random products (and associated users)
        }
        for ($i = 0; $i < 20; $i++) {
            $this->call(OrderSeeder::class);
        }
        //Create X reviews on random products
        for ($i = 0; $i < 20; $i++) {
            $this->call(ReviewSeeder::class);
        }
    }
}
