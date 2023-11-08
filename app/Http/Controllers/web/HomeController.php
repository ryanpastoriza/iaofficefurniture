<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class HomeController extends Controller {

    public function index() {

    	$product = new Product();
    	$category = new Category();
    	$featuredProducts = $product->getFeaturedProducts();

    	$categories = $category->parentCategory();

    	  // echo '<pre>';
       //      var_export($categories->toArray());
       //      echo '</pre>';

    	
    	return view('web.home')->with([
			'title' => 'Home', 
			'segment' => '',
			'categories' => $categories,
			'featuredProducts' => $featuredProducts
		]);
    }

}
