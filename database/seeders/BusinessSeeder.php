<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Craft;
use App\Models\Role;
use App\Models\Specialty;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Business::factory()
            ->for(User::factory())
            ->state(function() {
                //Random specialty or create one if specialties aren't seeded.
                $specialty = Specialty::inRandomOrder()->first() ?: Specialty::factory()->create();
                //Random theme or create one if themes aren't seeded.
                $theme = Theme::inRandomOrder()->first() ?: Theme::factory()->create();
                return [
                    'specialty_id' => $specialty->id,
                    'theme_id' => $theme->id,
                ];
            })
            ->afterCreating(function (Business $business) {
//                $specialties = Specialty::inRandomOrder()->take(2)->get();
//                $business->specialties()->attach($specialties);

                // Retrieve the business_owner role
                $businessOwnerRole = Role::where('name', 'business_owner')->first();
                // Assign the business_owner role to the user
                if ($businessOwnerRole) {
                    $business->user->roles()->attach($businessOwnerRole);
                }
            })
            ->create();
    }
}
