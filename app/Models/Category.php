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
    protected $appends = ['parent', 'featuredImage'];
    protected $fillable = [
        'name',
        'parent_category',
        'description',
        'slug',
        'image',
        'deleted',
    ];

    public const IMAGE_DIR = 'public/uploads/categories/';

    public function getImage() {
        return Storage::url(Category::IMAGE_DIR) . $this->image;
    }

    public function getFeaturedImageAttribute() {
        $image = ltrim(Storage::url(Category::IMAGE_DIR . $this->image), '/');

        if( file_exists($image) ) {
            return $image;
        }

        return Storage::url('public/uploads/default-image.jpg');
    }

    // public function getProductCountAttribute() {
    //     return $this->productCount = Product::where(['category_id' => $this->category_id ])->get()->count();
    // }

    public function getParentAttribute() {

        $category = Category::find($this->parent_category);

        if( $category ) {
            return $category->name;
        }
        return null;
    }

    public function subcategory() {
        return $this->hasMany(Category::class, 'parent_category', 'category_id');
    }

    public function main() {
        return $this->belongsTo(Category::class, 'parent_category', 'category_id');
    }

    // public function siblings() {
    //     return $this->hasMany(Category::class, 'parent_category', 'parent_category')->where('category_id', '<>', $this->category_id);
    // }

    // public function products() {
    //     return $this->hasMany(Product::class, 'category_id', 'category_id');
    // }

    // public static function addImgUrl($img) {

    //     if( file_exists(public_path('storage') . '/uploads/categories/' . $img) ) {
    //         return Storage::url('public/uploads/categories/' . $img);
    //     }
    //     return Storage::url('public/uploads/default-image.jpg');
       
    // }




    // public function parentCategory($exclude = 0) {

    //     $categories = null;

    //     $categories = Category::where(['parent_category' => 0])->where('category_id', '<>', $exclude)->get();    

    //     foreach ($categories as $category) {

    //         $category->subCategories = $this->getChildCategory($category->category_id);
    //         $category->image = $this->imgSrc($category->image);
    //     }

    //     return $categories;
    // }


    // public function getChildCategory($parentId, $exclude = 0) {
        
    //     $subCategories = Category::where(['parent_category' => $parentId])->where('category_id', '<>', $exclude)->get();

    //     foreach ($subCategories as $subCategory) {

    //         $subCategory->product_count = Product::where(['category_id' => $subCategory->category_id ])->get()->count();
    //         $subCategory->image = $this->imgSrc($subCategory->image);
    //     }

    //     return $subCategories;
    // }

    // public function imgSrc($img) {

    //     if( file_exists(public_path('storage') . '/uploads/categories/' . $img) ) {
    //         return Storage::url('public/uploads/categories/' . $img);
    //     }
    //     return Storage::url('public/uploads/default-image.jpg');
    // }

}
