<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends BaseController {

    public function index() {
	    return view('admin.category')->with([
			'title' => 'Categories', 
			'segment' => 'category'
		]);
	}

	public function populate() {

		$categories = Category::select(
			'c.category_id', 
			'c.name', 
			'c.slug', 
			'c.image',
			'c.description',
			'c.parent_category',
			'p.name AS parent_category_name'
		)
		->from('categories AS c')
		->leftJoin('categories AS p', 'c.parent_category', '=', 'p.category_id')
		->orderBy('c.parent_category', 'ASC')
		->orderBy('c.name', 'ASC')
		->get();

		return $this->sendResponse($categories, 'Categories');
	}

	
	public function destroy($id) {

		$categories = Category::whereIn('category_id', explode(',', $id))->get();

		foreach ($categories as $category) {
			
			if( $category->image ) {
				if( Storage::disk('public')->exists('uploads/categories/' . $category->image) ) {
					Storage::delete('public/uploads/categories/' . $category->image);
				}
			}

			$category->delete();
		}

		return $this->sendResponse($id, 'Delete');
	}

}
