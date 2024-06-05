<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        $data = json_decode(file_get_contents(__DIR__ . '\project_db.json'), true);
        $type_data = json_decode(file_get_contents(__DIR__ . '\type_db.json'), true);
        foreach ($data as $project) {
            $new_project = new Project();
            $new_project->title = $project['title'];
            $new_project->slug = Project::generateSlug($project['title']);
            $new_project->description = $project['description'];
            $new_project->type_id = $type_data[array_rand($type_data)]['id'];
            $new_project->created = $project['created'];
            $new_project->image_url = $project['image_url'];
            $new_project->save();
        }
    }
}
