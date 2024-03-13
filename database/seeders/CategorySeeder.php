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

   
        Category::insert(
        [
            [
        		'name' => 'Office Chair',
        		'parent_category' => 0,
        		'description' => $faker->text(150),
        		'slug' => 'office-chair',
        		'image' => 'office-chair.png'
            ],[
                'name' => 'Metal Locker',
                'parent_category' => 0,
                'description' => $faker->text(150),
                'slug' => 'metal-locker',
                'image' => 'metal-locker.jpg'
            ],[
                'name' => 'Office Table',
                'parent_category' => 0,
                'description' => $faker->text(150),
                'slug' => 'office-table',
                'image' => 'office-table.jpg'
            ],[
                'name' => 'Partition System',
                'parent_category' => 0,
                'description' => $faker->text(150),
                'slug' => 'partition-system',
                'image' => 'partition-system.jpg'
            ],[
                'name' => 'Steel Cabinets and Racks',
                'parent_category' => 0,
                'description' => $faker->text(150),
                'slug' => 'steel-cabinets-and-racks',
                'image' => 'steel-cabinets-and-racks.webp'
            ]

        ]);

        Category::insert(
        [
            [
                'name' => 'Executive Table',
                'parent_category' => 3,
                'description' => $faker->text(150),
                'slug' => 'executive-table',
                'image' => 'executive-table.jpg'
            ],[
                'name' => 'Foldable Table',
                'parent_category' => 3,
                'description' => $faker->text(150),
                'slug' => 'foldable-table',
                'image' => 'foldable-table.webp'
            ],[
                'name' => 'Gang Chair',
                'parent_category' => 1,
                'description' => $faker->text(150),
                'slug' => 'gang-chair',
                'image' => 'gang-chair.webp'
            ],[
                'name' => 'Office Teller Chair',
                'parent_category' => 1,
                'description' => $faker->text(150),
                'slug' => 'office-teller-chair',
                'image' => 'office-teller-chair.webp'
            ],[
                'name' => 'Mid-Back Office Chair',
                'parent_category' => 1,
                'description' => $faker->text(150),
                'slug' => 'mid-back-office-chair',
                'image' => 'mid-back-office-chair.jpg'
            ],[
                'name' => 'Executive Office Chair',
                'parent_category' => 1,
                'description' => $faker->text(150),
                'slug' => 'executive-office-chair',
                'image' => 'executive-office-chair.webp'
            ],
            [
                'name' => 'Stackable Visitor Chair',
                'parent_category' => 1,
                'description' => $faker->text(150),
                'slug' => 'stackable-visitor-chair',
                'image' => 'stackable-visitor-chair.jpg'
            ]

        ]);
        // }

    }
}
