<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $faker = Faker::create();
        $categories = Category::all();

        foreach ($categories as $category) {
        	
        	for ($i=0; $i < 10; $i++) { 

        		$code = $faker->regexify('[A-Z]{5}[0-4]{3}');
        		$name = $faker->words(1, true). ' ' .$category->name;
        		$slug = Str::slug($name . ' ' . $code);

        		$product = new Product();

				$product->category_id = $category->category_id;
		    	$product->price = $faker->randomNumber(5, true);
		        $product->on_demand = $faker->numberBetween(0, 1);
		    	$product->product_code = $code;
		    	$product->product_name = $name;
		    	$product->product_description = $faker->text(150);
		        $product->featured_image = $slug . '.jpg';
		        $product->slug = $slug;
		        $product->featured = $faker->numberBetween(0, 1);
		        $product->status = 1;
				$product->save();

				if( $product->product_id ) {
					$product->setDirectory();
					$storage = $product->getStorageUrl();
					$dir = storage_path('app/' . Product::DIR ) . $product->product_id . '/' . Product::IMAGE_DIR;
					$default = $faker->image($dir, 500, 500, 'Office furniture', true, true, $category->name, true, 'jpg');
					$images = Storage::files('public/uploads/products/' . $product->product_id . '/images/');
					Storage::move($images[0], 'public/uploads/products/' . $product->product_id . '/images/' . $product->featured_image);
					// Storage::move($images[0], 'public/uploads/products/' . $products->product_id . '/images/' . $products->featured_image);
					// Storage::move($default, $dir . $filename); 
				}
        	}

        }
   		
        // Chair
       //  Product::insert(
       //  [
       //      [
       //  		'category_id' => 11,
		    	// 'price' => $faker->randomNumber(5, true),
		     //    'on_demand' => 0,
		    	// 'product_code' => '46DJNTY',
		    	// 'product_name' => 'High-back Leatherette Executive Chair',
		    	// 'product_description' => $faker->text(150),
		     //    'featured_image' => 'high-back-leatherette-executive-chair-46DJNTY',
		     //    'slug' => 'high-back-leatherette-executive-chair-46DJNTY',
		     //    'featured' => 0,
		     //    'status' => 1
       //      ],
       //      [
       //  		'category_id' => 11,
		    	// 'price' => $faker->randomNumber(5, true),
		     //    'on_demand' => 0,
		    	// 'product_code' => '528FJNVY',
		    	// 'product_name' => 'High-back Leatherette Executive Chair',
		    	// 'product_description' => $faker->text(150),
		     //    'featured_image' => 'high-back-leatherette-executive-chair-528FJNVY',
		     //    'slug' => 'high-back-leatherette-executive-chair-528FJNVY',
		     //    'featured' => 0,
		     //    'status' => 1
       //      ],[
       //  		'category_id' => 11,
		    	// 'price' => $faker->randomNumber(5, true),
		     //    'on_demand' => 0,
		    	// 'product_code' => 'M20',
		    	// 'product_name' => 'Mesh Executive Chair',
		    	// 'product_description' => $faker->text(150),
		     //    'featured_image' => 'mesh-executive-chair-M20',
		     //    'slug' => 'mesh-executive-chair-M20',
		     //    'featured' => 0,
		     //    'status' => 1
       //      ],[
       //  		'category_id' => 11,
		    	// 'price' => $faker->randomNumber(5, true),
		     //    'on_demand' => 0,
		    	// 'product_code' => '915JNTY',
		    	// 'product_name' => 'Mesh Executive Chair',
		    	// 'product_description' => $faker->text(150),
		     //    'featured_image' => 'high-back-mesh-executive-chair-915JNTY',
		     //    'slug' => 'high-back-mesh-executive-chair-915JNTY',
		     //    'featured' => 0,
		     //    'status' => 1
       //      ],[
       //  		'category_id' => 6,
		    	// 'price' => $faker->randomNumber(5, true),
		     //    'on_demand' => 0,
		    	// 'product_code' => 'OT-209',
		    	// 'product_name' => 'Office Table',
		    	// 'product_description' => $faker->text(150),
		     //    'featured_image' => 'office-table-OT-209',
		     //    'slug' => 'office-table-OT-209',
		     //    'featured' => 0,
		     //    'status' => 1
       //      ]
       //  ]);
    }
}
