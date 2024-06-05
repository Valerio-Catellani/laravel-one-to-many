<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type_data = json_decode(file_get_contents(__DIR__ . '\type_db.json'), true);

        foreach ($type_data as $type) {
            $new_type = new Type();
            $new_type->name = $type['name'];
            $new_type->slug = Type::generateSlug($type['name']);
            $new_type->save();
        }
    }
}
