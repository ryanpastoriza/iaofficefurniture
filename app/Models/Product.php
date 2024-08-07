<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $appends = ['featuredImg'];

    protected $fillable = [
    	'category_id',
    	'price',
        'on_demand',
    	'product_code',
    	'product_name',
    	'product_description',
        'featured_image',
        'slug',
        'featured',
        'dimension',
        'materials',
        'color',
        'status'
    ];

    public const DIR = 'public/uploads/products/';

    public const IMAGE_DIR = 'images/';

    public function category() {
         return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    public function setDirectory() {

        $dir = storage_path('app/' . Product::DIR ) . $this->product_id . '/' . Product::IMAGE_DIR;
        File::makeDirectory($dir, 0777, true, true);
    }

    public function getDirectory() {
        return Product::DIR . $this->product_id . '/' . Product::IMAGE_DIR;
    }

    public function getStorageUrl() {
        return ltrim(Storage::url(Product::DIR . $this->product_id . '/' . Product::IMAGE_DIR), '/');
    }

    public function imageUpload($img, $isFeatured = false, $filename = '') {

        $ext = $img->getClientOriginalExtension();

        if( $isFeatured ) {

            $filename = $this->slug . '.' . $ext;
            $img->storeAs($this->getDirectory(), $filename);
            $this->featured_image = $filename;
            $this->save();
            return;
        }

        $filename = $filename . '.' . $ext;
        $img->storeAs($this->getDirectory(), $filename);
    }

    public function getFeaturedProducts() {

        return Product::where(['featured' => 1])->limit(10)->get();
    }

    public function getFeaturedImgAttribute() {
        $image = ltrim(Storage::url(Product::DIR . $this->product_id . '/' . Product::IMAGE_DIR . $this->featured_image), '/');

        if( file_exists($image) ) {
            return $image;
        }

        return Storage::url('public/uploads/default-image.jpg');
    }

    public static function search($search) {

        $products = Product::join('categories', 'product.category_id', '=', 'categories.category_id')
                            ->where('product.product_code', 'LIKE', '%'.$search.'%')
                            ->orWhere('product.product_name', 'LIKE', '%'.$search.'%')
                            ->orWhere('product.product_description', 'LIKE', '%'.$search.'%')
                            ->orWhere('categories.name', 'LIKE', '%'.$search.'%')
                            ->select('product.*')
                            ->get();

        return $products;
    }

    // public function getOtherImgAttribute() {

    //     return $this->otherImg = [
    //         'images' => $this->otherImages(),
    //         'src' => $this->otherImages('src')
    //     ];
    // }

    // public function category() {
    //     return $this->belongsTo(Category::class, 'category_id', 'category_id');
    // }

    // public function makeDir() {

    //     $root = storage_path('app/public/uploads/products/');
    //     $main = $root . $this->product_id . '/';
    //     $others = $main . 'others/';
    //     File::makeDirectory($main, 0777, true, true);
    //     File::makeDirectory($others, 0777, true, true);
    // }

    // public function getDir() {
    //     return Product::DIR . $this->product_id . '/';
    // }

    // public function getOthersDir() {
    //      return Product::DIR . $this->product_id . '/others/';
    // }

    // public function featuredImage($info = 'filename') {

    //     $img = Storage::files('public/uploads/products/' . $this->product_id . '/');

    //     if( $info != 'filename' ) {
    //         return $this->imgPath($img[0]);
    //     }

    //     return $this->getFilename($img[0]);
    // }

    // public function otherImages($info = 'filename') {
    //     $images = Storage::files('public/uploads/products/' . $this->product_id . '/others/');

    //     if( $info != 'filename' && count($images) > 0 ) {
    //         return $this->imgPath($images[0]);
    //     }
        
    //     $others = [];
    //     foreach ($images as $image) {
    //         $others[] = $this->getFilename($image);
    //     }

    //     return $others;
    // }

    // public function getFilename($img) {
    //     $details = pathinfo($img);
    //     return $details['basename'];
    // }

    // public function imgPath($img) {
    //     $details = pathinfo($img);
    //     return Storage::url($details['dirname']);
    // }

    // public function getProducts($ids = []) {

    //     if( is_array($ids) && count($ids) > 0 ) {
    //         return Product::whereIn('category_id', $ids)->get();
    //     }
    // }

    // public function getProductsByCategory($categoryId, $isParent = false) {

    //     if( $isParent ) {
    //        $categoryId = Category::where(['parent_category' => $categoryId])->pluck('category_id');
    //     }else{
    //         $categoryId = array($categoryId);
    //     }

    //     $products = Product::whereIn('category_id', $categoryId)->get();

    //     foreach ($products as $product) {
            
    //         $product->category = Category::where(['category_id' => $product->category_id])->first()->name;
    //         $product->featured_image = $product->featuredImage();
    //         $product->other_images = $product->otherImages();
    //         $product->img_src = array(
    //             'featured' => $product->featuredImage('src'),
    //             'others' => $product->otherImages('src')
    //         );

    //     }

    //     return $products;
    // }

    // public function getFeaturedProducts($limit = false) {

    //     if( !$limit ) {
    //         $products = Product::where(['featured' => 1])->get();
    //     }else{
    //         $products = Product::where(['featured' => 1])->limit($limit)->get();
    //     }

    //     foreach ($products as $product) {
            
    //         $product->category = Category::where(['category_id' => $product->category_id])->first()->name;
    //         $product->featured_image = $product->featuredImage();
    //         $product->other_images = $product->otherImages();
    //         $product->img_src = array(
    //             'featured' => $product->featuredImage('src'),
    //             'others' => $product->otherImages('src')
    //         );
    //     }

    //     return $products;
    // }

    // public function populate() {

    //     $products = Product::all();

    //     foreach ($products as $product) {
          
    //         $product->featured_image = $product->featuredImage();
    //         $product->img_src = $product->featuredImage('src');
            
    //     }

    //     return $products;

    // }

    // public function randomProducts() {

    //     $products = Product::inRandomOrder()->take(10)->get();

    //     foreach ($products as $product) {
          
    //         $product->featured_image = $product->featuredImage();
    //         $product->img_src = $product->featuredImage('src');
            
    //     }

    //     return $products;
    // }

    // public function onDemandProducts() {
        
    // }

    // public function searchProducts($search) {

    //     $products = Product::join('categories', 'product.category_id', '=', 'categories.category_id')
    //                         ->where('product.product_code', 'LIKE', '%'.$search.'%')
    //                         ->orWhere('product.product_name', 'LIKE', '%'.$search.'%')
    //                         ->orWhere('product.product_description', 'LIKE', '%'.$search.'%')
    //                         ->orWhere('categories.name', 'LIKE', '%'.$search.'%')
    //                         ->select('product.*')
    //                         ->get();


    //     foreach ($products as $product) {
            
    //         $product->category = Category::where(['category_id' => $product->category_id])->first()->name;
    //         $product->featured_image = $product->featuredImage();
    //         $product->other_images = $product->otherImages();
    //         $product->img_src = array(
    //             'featured' => $product->featuredImage('src'),
    //             'others' => $product->otherImages('src')
    //         );
    //     }

    //     return $products;

    // }
}
