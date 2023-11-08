<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $parentCategories = [
        	[
        		'name' => 'Office Chair',
        		'parent_category' => 0,
        		'description' => $faker->text,
        		'slug' => 'office-chair',
        		'image' => 'office-chair.jpg'
        	]
        ];


        // foreach (range(1, 5) as $index) {

        	Category::create([
        		'name' => 'Office Chair',
        		'parent_category' => 0,
        		'description' => $faker->text,
        		'slug' => 'office-chair',
        		'image' => 'office-chair.jpg'
        	]);
        // }

    }
}
