<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
        'parent_category',
        'description',
        'slug',
        'image',
        'deleted',
    ];

    public function parentCategory() {

        $categories = null;

        $categories = Category::where(['parent_category' => 0])->get();    

        foreach ($categories as $category) {

            $category->subCategories = $this->getChildCategory($category->category_id, 1);
            $category->image = $this->imgSrc($category->image);
        }

        return $categories;
    }


    public function getChildCategory($parentId) {
        
        $subCategories = Category::where(['parent_category' => $parentId])->get();

        foreach ($subCategories as $subCategory) {

            $subCategory->product_count = Product::where(['category_id' => $subCategory->category_id ])->get()->count();
            $subCategory->image = $this->imgSrc($subCategory->image);
        }

        return $subCategories;
    }

    public function imgSrc($img) {

        if( file_exists(public_path('storage') . '/uploads/categories/' . $img) ) {
            return Storage::url('public/uploads/categories/' . $img);
        }
        return Storage::url('public/uploads/default-image.jpg');
    }

}
