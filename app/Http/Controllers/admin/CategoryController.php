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

	public function store(Request $request) {

		$input = $request->all();

		$category = new Category();
		$category->name = $input['name'];
		$category->parent_category = $input['parent_category'];
		$category->description = $input['description'];
		$category->slug = strtolower($input['slug']);


		if( $request->hasFile('img') ) {
			$image = $request->file('img');
			$ext = $image->getClientOriginalExtension();
			$filename = str_replace(" ", "-", strtolower($category->name)) . '.' . $ext;
			$image->storeAs('public/uploads/categories/', $filename);
			$category->image = $filename;
		}

		$category->save();
		return $this->sendResponse($category, 'New Category has been created');
	}

	public function update(Request $request, Category $category) {

		$input = $request->all();
		$category->name = $input['name'];
		$category->parent_category = $input['parent_category'];
		$category->description = $input['description'];
		$category->slug = strtolower($input['slug']);

		if( $request->hasFile('img') ) {
			$image = $request->file('img');
			$ext = $image->getClientOriginalExtension();
			$filename = str_replace(" ", "-", strtolower($category->name)) . '.' . $ext;
			$image->storeAs('public/uploads/categories/', $filename);
			$category->image = $filename;
		}

		$category->save();
		return $this->sendResponse($category, 'Category has been updated');
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
