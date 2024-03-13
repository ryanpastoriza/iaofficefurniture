<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Http\Resources\CategoryCollection as CategoryResource;

class HomeController extends Controller {

    public function index() {

        $categories = Category::where(['parent_category' => 0])->get();
        $subcategories = Category::where('parent_category', '>', 0)->orderby('parent_category')->limit(2)->get();
    	$product = new Product();
        $products = $product->getFeaturedProducts();

    	return view('web.home')->with([
			'title' => 'I&A Office Furniture Philippines : Quality Office Furniture',
			'categories' => $categories,
            'subcategories' => $subcategories,
			'featuredProducts' => $products
		]);
    }

}
