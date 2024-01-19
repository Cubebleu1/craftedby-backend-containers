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
                'Conception de menuiseries',
                'Menuiserie à froid',
                'Menuiserie à chaleur',
                'Menuiserie pour bâtiments',
                'Menuiserie pour jardins',
                'Menuiserie pour murs',
                'Menuiserie pour meubles',
                'Menuiserie pour mobiliers',
                'Conception de vêtements',
                'Verrier à froid',
                'Verrier à chaleur',
                'Verrier pour bâtiments',
                'Verrier pour jardins',
                'Verrier pour murs',
                'Verrier pour meubles',
                'Verrier pour mobiliers',
                'Conception de mobiliers',
                'Broderie à froid',
                'Broderie à chaleur',
                'Broderie pour bâtiments',
                'Broderie pour jardins',
                'Broderie pour murs',
                'Broderie pour meubles',
                'Broderie pour mobiliers',
                'Conception de pots de céramique',
                'Céramique à froid',
                'Céramique à chaleur',
                'Céramique pour bâtiments',
                'Céramique pour jardins',
                'Céramique pour murs',
                'Céramique pour meubles',
                'Céramique pour mobiliers',
                'Conception d\'objets ébénistes',
                'Objets ébénistes à froid',
                'Objets ébénistes à chaleur',
                'Objets ébénistes pour bâtiments',
                'Objets ébénistes pour jardins',
                'Objets ébénistes pour murs',
                'Objets ébénistes pour meubles',
                'Objets ébénistes pour mobiliers',
                'Conception de mobiliers',
                'Encadrement à froid',
                'Encadrement à chaleur',
                'Encadrement pour bâtiments',
                'Encadrement pour jardins',
                'Encadrement pour murs',
                'Encadrement pour meubles',
                'Encadrement pour mobiliers',
                'Conception de mobiliers',
                'Ferronnage à froid',
                'Ferronnage à chaleur',
                'Ferronnage pour bâtiments',
                'Ferronnage pour jardins',
                'Ferronnage pour murs',
                'Ferronnage pour meubles',
                'Ferronnage pour mobiliers',
                'Conception de mobiliers',
                'Horlogerie à froid',
                'Horlogerie à chaleur',
                'Horlogerie pour bâtiments',
                'Horlogerie pour jardins',
                'Horlogerie pour murs',
                'Horlogerie pour meubles',
                'Horlogerie pour mobiliers',
                'Conception de mobiliers',
                'Maroquinerie à froid',
                'Maroquinerie à chaleur',
                'Maroquinerie pour bâtiments',
                'Maroquinerie pour jardins',
                'Maroquinerie pour murs',
                'Maroquinerie pour meubles',
                'Maroquinerie pour mobiliers',
            ];

        foreach ($specialties as $specialty) {
            Specialty::firstOrCreate(['name' => $specialty,]);        }
    }
}
