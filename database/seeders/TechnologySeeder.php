<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tecnologies = ['Laravel', 'PHP', 'Javascript', 'HTML', 'CSS', 'Bootstrap', 'Vue', 'Vite'];


        foreach ($tecnologies as $tecnology) {
            $newTecnology = new Technology();
            $newTecnology->name = $tecnology;
            $newTecnology->slug = Str::slug($newTecnology->name, '-');
            $newTecnology->save();
        }
    }
}
