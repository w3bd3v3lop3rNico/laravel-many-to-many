<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $new_project = new Project();

            $new_project->title = $faker->sentence(5);
            $new_project->description = $faker->text(100);
            $new_project->slug = Str::slug($new_project->title, '-');
            $new_project->save();
        
        }
    }
}
