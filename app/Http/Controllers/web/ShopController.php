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
        
        $categories = Category::where(['parent_category' => 0])->with('subcategory')->get();
        $products = Product::all();

        $breadcrumbs = [
            'title' => 'Shop Overview',
            'name' => 'Shop',
            'items' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                    'class' => 'crumbs'
                ]
            ]
        ];

    	return view('web.shop')->with([
			'title' => 'Office Furniture Products : I&A Office Furniture Philippines',
            'categories' => $categories,
            'products' => $products,
            // 'breadcrumbs' => $breadcrumbs
		]);
    }

    public function category(Request $request, $main = null, $sub = null) {

        $slug = $sub;
        if( !$slug ) {
            $slug = $main;
        }

        $current = Category::where(['slug' => $slug])->with('subcategory', 'main')->first();
        $ids = [ $current->category_id ];
  
        if( !$current ) {
            error(404);
        }

        if( count($current->subcategory) ) {

            foreach ($current->subcategory as $subcat) {
                $ids[] = $subcat->category_id;
            }
        }

        // echo '<pre>';
        // var_export($current->toArray());
        // echo '</pre>';

        $categories = Category::where(['parent_category' => 0])->with('subcategory')->get();
        $products = Product::whereIn('category_id', $ids)->get();

        // $items[] = [
        //         'label' => 'Home',
        //         'url' => route('home'),
        //         'class' => 'crumbs'
        // ];
       

        // if( $sub ) {
        //     $items[] = [
        //         'label' => $current->main->name,
        //         'url' => route('category', $current->main->slug),
        //         'class' => 'crumbs'
        //     ];
        // }

        // $breadcrumbs = [
        //     'title' => $current->name,
        //     'name' => $current->name,
        //     'items' => $items
        // ];

        return view('web.category')->with([
            'title' =>  $current->name .' : I&A Office Furniture Philippines',
            'categories' => $categories,
            'products' => $products,
            'main' => $main,
            'sub' => $sub,
            'current' => $current,
            // 'breadcrumbs' => $breadcrumbs,
            'subcategories' => $current->subcategory
        ]);
    }

    public function search(Request $request, $search = null) {

        $products = Product::search($search);
        $categories = Category::where(['parent_category' => 0])->with('subcategory')->get();

        //  $items[] = [
        //         'label' => 'Home',
        //         'url' => route('home'),
        //         'class' => 'crumbs'
        // ];

        // $breadcrumbs = [
        //     'title' => 'Search Results for: ' . $search,
        //     'name' => "Search Results for '{$search}'",
        //     'items' => $items
        // ];

        return view('web.search-results')->with([
            'title' => 'Search Results for: ' . $search,
            'categories' => $categories,
            'products' => $products,
            // 'breadcrumbs' => $breadcrumbs,
            'search' => $search
        ]);

    }

    public function product(Request $request) {

        $categories = Category::where(['parent_category' => 0])->get();
        $product = Product::where(['slug' => $request->slug])->with('category.main')->first();

        // echo '<pre>';
        // var_export($product->toArray());
        // echo '</pre>';
        // var_export(expression)
        // $product->category = Category::find($product->category_id)->name;
        // $product->featured_image = $product->featuredImage();
        // $product->other_images = $product->otherImages();
        // $product->img_src = array(
        //     'featured' => $product->featuredImage('src'),
        //     'others' => $product->otherImages('src')
        // );

        // $randomProducts = $product->randomProducts();


        // $items[] = [
        //         'label' => 'Home',
        //         'url' => route('home'),
        //         'class' => 'crumbs'
        // ];

        // $slug = null;
        // if( $product->category->main ) {
        //     $items[] = [
        //             'label' => $product->category->main->name,
        //             'url' => route('shop.category', $product->category->main->slug),
        //             'class' => 'crumbs'
        //     ];

        //     $slug = $product->category->main->slug . '/';

        // }

        // $items[] = [
        //         'label' => $product->category->name,
        //         'url' => route('shop.category', $slug.$product->category->slug),
        //         'class' => 'crumbs'
        // ];

        // $breadcrumbs = [
        //     'title' => $product->product_name,
        //     'name' => $product->product_code,
        //     'items' => $items
        // ];

        return view('web.product')->with([
            'title' => $product->product_name . ' - ' . $product->product_code . ' : I&A Office Furniture Philippines',
            'product' => $product,
            'categories' => $categories
            // 'breadcrumbs' => $breadcrumbs
        ]);
    }

}
