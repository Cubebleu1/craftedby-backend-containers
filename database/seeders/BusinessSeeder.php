<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Craft;
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
                //Random craft or create one if crafts aren't seeded.
                $craft = Craft::inRandomOrder()->first() ?: Craft::factory()->create();
                //Random theme or create one if themes aren't seeded.
                $theme = Theme::inRandomOrder()->first() ?: Theme::factory()->create();
                return [
                    'craft_id' => $craft->id,
                    'theme_id' => $theme->id,
                ];
            })
            ->afterCreating(function (Business $business) {
                $specialties = Specialty::inRandomOrder()->take(2)->get();
                $business->specialties()->attach($specialties);
            })
            ->create();
    }
}
