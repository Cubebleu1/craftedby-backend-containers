<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $themes = [
            'pastel',
            'autumn',
            'garden',
            'retro',
            'artisan',
        ];
        foreach ($themes as $theme) {
            Theme::firstOrCreate(['name' => $theme,]);        }
    }
}
