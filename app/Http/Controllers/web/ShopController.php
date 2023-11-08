<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    public function index() {
    	
        $category = new Category();
        $categories =  $category->parentCategory();
        $product = new Product();
        $featuredProducts = $product->getFeaturedProducts();

    	return view('web.shop')->with([
			'title' => 'Shop',
            'categories' => $categories,
            'featuredProducts' => $featuredProducts
		]);
    }

    public function category(Request $request) {

        $product = new Product();
        $products = [];
        $category = Category::where(['slug' => $request->slug ])->first();
        

        if( !$category ) {
            Abort(404);
        }

        if( !$category->parent_category ) {

            $category->subCategories = $category->getChildCategory($category->category_id);
            $category->image = $category->imgSrc($category->image);
            $products = $product->getProductsByCategory($category->category_id);

            return view('web.category')->with([
                'title' => $category->name,
                'category' => $category,
                'products' => $products
            ]);


        }

         // $category

        // echo '<pre>';   
        // var_export( $category->toArray());
        // echo '</pre>';

        $category->parent = Category::where(['category_id' => $category->parent_category ])->first()->name;
        $products = $product->getProductsByCategory($category->category_id, false);
        return view('web.sub-category')->with([
            'title' => $category->name,
            'category' => $category,
            'products' => $products
        ]);
    }

    public function product(Request $request) {

        $product = Product::where(['slug' => $request->slug])->first();
        $product->category = Category::find($product->category_id)->name;
        $product->featured_image = $product->featuredImage();
        $product->other_images = $product->otherImages();
        $product->img_src = array(
            'featured' => $product->featuredImage('src'),
            'others' => $product->otherImages('src')
        );

        $randomProducts = $product->randomProducts();

        // echo '<pre>';   
        // var_export($product);
        // echo '</pre>';

        return view('web.product')->with([
            'title' => 'Product',
            'product' => $product,
            'randomProducts' => $randomProducts
        ]);
    }

    public function search(Request $request) {

        $search = $request->s;

        $product = new Product();
        $products = $product->searchProducts($search);

        // echo '<pre>';   
        // var_export($products->toArray());
        // echo '</pre>';


        return view('web.search-results')->with([
            'title' => 'Search Results',
            'products' => $products,

        ]);

    }
}
