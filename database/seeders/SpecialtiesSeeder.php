<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            'Menuiserie',
            'Couturerie',
            'Verrier',
            'Broderie',
            'Céramiste',
            'Ebénisterie',
            'Ferronnage',
            'Horlogerie',
            'Maroquinerie',
            'Joaillerie',
            'Tapissier',
            'Sellier',
            'Vannier',
            'Poterie',
            'Autre'
            ];

        foreach ($specialties as $specialty) {
            Specialty::firstOrCreate(['name' => $specialty,]);        }
    }
}
