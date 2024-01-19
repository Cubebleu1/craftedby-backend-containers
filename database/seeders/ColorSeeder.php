<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Black',
            'White',
            'Red',
            'Brown',
            'Yellow',
            'Green',
            'Blue',
            'Purple',
            'Orange',
        ];


        foreach ($colors as $color) {
            Color::firstOrCreate([
                'name' => $color,
            ]);
        }
    }
}
