<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Resources\ProductCollection as ProductResource;
use Illuminate\Support\Str;
use App\Models\Product;

class ProductController extends BaseController
{
    
    public function index() {

    	$product = Product::all();
        return $this->sendResponse(ProductResource::collection($product), 'Data');

    	// echo '<pre>';
    	// var_export(ProductResource::collection($product));
    	// echo '</pre>';
  //   	$products = Product::select('product.*', 'categories.name as category', 'categories.parent_category')
		// 					->join('categories', 'product.category_id', '=', 'categories.category_id')
		// 					->get();

		// foreach ($products as $product) {
		// 	$product->parent_category_name = NULL;
			
		// 	if( $product->parent_category > 0 ){
		// 		$product->parent_category_name = Category::where(['category_id' => $product->parent_category])->first()->name;	
		// 	}
			
		// }
    }

    public function store(Request $request) {
    		
		$product = new Product();

		$product->category_id = $request->input('category_id');
		$product->price = $request->input('price');
		$product->on_demand = $request->input('on_demand');
		$product->product_code = $request->input('product_code');
		$product->product_name = $request->input('product_name');
		$product->product_description = $request->input('product_description');
		$product->slug = Str::slug($product->product_name . ' ' . $product->product_code);
		// $product->dimension = $request->input('dimension');
		// $product->materials = $request->input('materials');
		$product->featured = $request->input('featured');
		$product->status = $request->input('status');
		$product->save();

		if( $product->product_id ) {

			$product->setDirectory();

			if( $request->hasFile('featuredimg') ) {
				$featuredImage = $request->file('featuredimg');
				$product->imageUpload($featuredImage, true);		
			}

			if( $request->hasFile('image_1') ) {
				$image_1 = $request->file('image_1');
				$product->imageUpload($image_1, false, 'image_1');
			}

			if( $request->hasFile('image_2') ) {
				$image_2 = $request->file('image_2');
				$product->imageUpload($image_2, false, 'image_2');
			}

			if( $request->hasFile('image_3') ) {
				$image_3 = $request->file('image_3');
				$product->imageUpload($image_3, false, 'image_3');
			}

			return $this->sendResponse(new ProductResource($product), 'Product has been created');
		}
		// return $this->sendResponse(new ProductResource($product), 'Product has been created');
		return $this->sendError('Something Went Wrong', 'Error', 200);
    }

 	public function show(Product $product) {

		return $this->sendResponse(new ProductResource($product), 'Product');
	}
 	public function update(Request $request, Product $product) {

 		$product->category_id = $request->input('category_id');
		$product->price = $request->input('price');
		$product->on_demand = $request->input('on_demand');
		$product->product_code = $request->input('product_code');
		$product->product_name = $request->input('product_name');
		$product->product_description = $request->input('product_description');
		$product->slug = Str::slug($product->product_name . ' ' . $product->product_code);
		// // $product->dimension = $request->input('dimension');
		// // $product->materials = $request->input('materials');
		$product->featured = $request->input('featured');
		$product->status = $request->input('status');
		$product->save();

		if( $request->hasFile('featuredimg') ) {
			$featuredImage = $request->file('featuredimg');
			$product->imageUpload($featuredImage, true);		
		}

		if( $request->hasFile('image_1') ) {
			$image_1 = $request->file('image_1');
			$product->imageUpload($image_1, false, 'image_1');
		}

		if( $request->hasFile('image_2') ) {
			$image_2 = $request->file('image_2');
			$product->imageUpload($image_2, false, 'image_2');
		}

		if( $request->hasFile('image_3') ) {
			$image_3 = $request->file('image_3');
			$product->imageUpload($image_3, false, 'image_3');
		}

		return $this->sendResponse($product, 'Product has been updated');


 	}
 	public function destroy($id) {

 		$products = Product::whereIn('product_id', explode(',', $id))->get();

		foreach ($products as $product) {

			$dir = Product::DIR . $product->product_id;

			if( Storage::exists($dir) ) {
				Storage::deleteDirectory($dir);
			}
			$product->delete();
		}

		return $this->sendResponse($products, 'Delete');

 	}


}
