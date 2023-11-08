<?php

namespace App\Http\Controllers\admin;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends BaseController
{
    public function index() {
		return view('admin.product')->with([
			'title' => 'Products', 
			'segment' => 'products',
		]);
	}

	public function show(Product $product) {

		$product->featured_image = $product->featuredImage();
		$product->other_images = $product->otherImages();
		$product->img_src = array(
			'featured' => $product->featuredImage('src'),
			'others' => $product->otherImages('src')
		);

		return $this->sendResponse($product, 'Product');

	}

	public function populate() {

		$products = Product::select('product.*', 'categories.name as category', 'categories.parent_category')
							->join('categories', 'product.category_id', '=', 'categories.category_id')
							->get();

		foreach ($products as $product) {
			$product->parent_category_name = Category::where(['category_id' => $product->parent_category])->first()->name;
		}

		return $this->sendResponse($products, 'Product List');
	}

	public function store(Request $request) {

		$input = $request->all();

		$product = new Product();

		$product->category_id = $input['category_id'];
		$product->price = $input['price'];
		$product->on_demand = $input['on_demand'];
		$product->product_code = $input['product_code'];
		$product->product_name = $input['product_name'];
		$product->product_description = $input['product_description'];
		$product->slug = str_replace(" ", "-", strtolower($product->product_name)) . '-' . str_replace(" ", "-", strtolower($product->product_code));
		$product->dimension = $input['dimension'];
		$product->materials = $input['materials'];
		$product->save();

		if( $product->product_id ) {
			$product->makeDir();
		}

		if( $request->hasFile('featuredimg') ) {

			$featuredImg = $request->file('featuredimg');
			$featuredImg->storeAs(
				$product->getDir(), 
				$featuredImg->getClientOriginalName()
			);
		}

		if( $request->hasFile('otherimg') ) {
			
			foreach($request->file('otherimg') as $image) {

				$image->storeAs(
					$product->getOthersDir(),
					$image->getClientOriginalName()
				);
			}
		}

		return $this->sendResponse($product, 'Created a new Product');

	}

	public function update(Request $request, Product $product) {

		$input = $request->all();

		$product->category_id = $input['category_id'];
		$product->price = $input['price'];
		$product->on_demand = $input['on_demand'];
		$product->product_code = $input['product_code'];
		$product->product_name = $input['product_name'];
		$product->product_description = $input['product_description'];
		$product->slug = str_replace(" ", "-", strtolower($product->product_name)) . '-' . str_replace(" ", "-", strtolower($product->product_code));
		$product->dimension = ($input['dimension'] == 'null') ? '' : $input['dimension'];
		$product->materials = ($input['materials'] == 'null') ? '' : $input['materials'];
		$product->save();

		if( $request->hasFile('featuredimg') ) {

			$featuredImg = $request->file('featuredimg');
			$featuredImg->storeAs(
				$product->getDir(), 
				$featuredImg->getClientOriginalName()
			);

		}

		if( $request->hasFile('otherimg') ) {
			
			foreach($request->file('otherimg') as $image) {

				$image->storeAs(
					$product->getOthersDir(),
					$image->getClientOriginalName()
				);
			}

		}

		return $this->sendResponse($product, 'Product information has been updated');
	}

	public function setFeaturedProducts(Request $request) {

		$isFeatured = $request->isFeatured;
		$ids = $request->product_id;

		$products = Product::whereIn('product_id', $ids)->update(['featured' => $isFeatured]);

		return $this->sendResponse($products, '');
	}

	public function removeImage(Request $request) {

		$file = $request->file;
		$filepath = Str::replace('/storage', '', $file);
		Storage::disk('public')->delete($filepath);
	}

	public function destroy($id) {

		$products = Product::whereIn('product_id', explode(',', $id))->get();

		foreach ($products as $product) {

			$dir = 'public/uploads/products/' . $product->product_id;

			if( Storage::exists($dir) ) {
				Storage::deleteDirectory($dir);
			}

			$product->delete();
		}

		return $this->sendResponse($id, 'Delete');
	}

}