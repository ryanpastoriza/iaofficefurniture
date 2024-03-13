<?php

namespace App\Http\Controllers\api;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Resources\CategoryCollection as CategoryResource;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $category = Category::all();
        return $this->sendResponse(CategoryResource::collection($category), 'Data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $category = new Category();
        $category->name = $request->input('name');
        $category->parent_category = $request->input('parent_category');
        $category->description = $request->input('description');
        $category->slug = Str::slug($request->input('slug'));

        if( $request->hasFile('img') ) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = $category->slug . '.' . $ext ;
            $file->storeAs('public/uploads/categories/', $filename);
            $category->image = $filename;
        }

        $category->save();
        return $this->sendResponse(new CategoryResource($category), 'New Category has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
       return new CategoryResource($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $input = $request->all();
        $category->name = $input['name'];
        $category->parent_category = $input['parent_category'];
        $category->description = $input['description'];
        $category->slug = strtolower($input['slug']);

        if( $request->hasFile('img') ) {
            $file = $request->file('img');
            $ext = $file->getClientOriginalExtension();
            $filename = $category->slug . '.' . $ext ;
            $file->storeAs('public/uploads/categories/', $filename);
            $category->image = $filename;
        }

        $category->save();
        return $this->sendResponse($category, 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $categories = Category::whereIn('category_id', explode(',', $id))->get();

        foreach ($categories as $category) {
            
            if( $category->image ) {
                if( Storage::exists(Category::IMAGE_DIR . '/' . $category->image) ) {
                    Storage::delete(Category::IMAGE_DIR . '/' . $category->image);
                }
            }

            $category->delete();
        }
     
        return $this->sendResponse('Deleted', 'Selected Category has been removed');
    }
}
