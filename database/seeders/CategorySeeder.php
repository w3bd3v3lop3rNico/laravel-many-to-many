<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = ['FrontEnd', 'BackEnd', 'FullStack', 'Design', 'DevOps'];

        foreach ($categories as $category_name) {

            $new_category = new Category();
            $new_category->name = $category_name;
            $new_category->slug = Str::slug($category_name);

            $new_category->save();
        }
    }
}
