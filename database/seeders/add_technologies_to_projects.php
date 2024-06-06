<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;

class add_technologies_to_projects extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Ottieni tutti i progetti
        $projects = Project::all();

        // Ottieni tutti gli ID delle tecnologie
        $technology_ids = Technology::pluck('id')->toArray();

        // Ciclo su ogni progetto
        foreach ($projects as $project) {
            // Mischia l'array degli ID delle tecnologie
            shuffle($technology_ids);

            // Genera un numero casuale da 2 a 7
            $num_technologies = rand(2, 7);

            // Seleziona il numero necessario di ID di tecnologia dall'array mischiato
            $random_technology_ids = array_slice($technology_ids, 0, $num_technologies);

            // Assegna gli ID delle tecnologie al progetto senza duplicati
            $project->technologies()->sync($random_technology_ids);
        }
    }
}
