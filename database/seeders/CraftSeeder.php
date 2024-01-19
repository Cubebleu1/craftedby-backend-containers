<?php

namespace Database\Seeders;

use App\Models\Craft;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CraftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crafts = [
            'Menuisier',
            'Verrier',
            'Brodeur',
            'Céramiste',
            'Ébéniste',
            'Encadreur',
            'Ferronnier',
            'Horloger',
            'Maroquinier',
            'Orfèvre',
            'Sellier',
            'Tailleur',
            'Tapissier',
            'Vitrailliste',
        ];

        foreach ($crafts as $craft) {
            Craft::create([
                'name' => $craft,
            ]);
        }
    }
}
