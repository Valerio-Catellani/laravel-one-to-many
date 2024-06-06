<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(__DIR__ . '\technology_db.json'), true);

        foreach ($data as $technology) {
            $new_technology = new Technology();
            $new_technology->name = $technology['name'];
            $new_technology->slug = Technology::generateSlug($technology['name']);
            $new_technology->color = $technology['color'];
            $new_technology->icon = $technology['icon'];
            $new_technology->save();
        }
    }
}
