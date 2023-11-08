<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
|
*/
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\InquiryController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Website Controllers
|--------------------------------------------------------------------------
|
*/
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\AboutController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/office-furniture-shop', [ShopController::class, 'index'])->name('shop');
Route::get('/office-furniture-shop/{slug}', [ShopController::class, 'category'])->name('shop.category');
Route::get('/product/{slug}', [ShopController::class, 'product'])->name('shop.product');
Route::get('/search/', [ShopController::class, 'search'])->name('product.search');
Route::get('/about-us', [AboutController::class, 'index'])->name('about-us');
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us');

Route::post('admin/inquiry/store', [InquiryController::class, 'store'])->name('inquiry.store');
// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => ['guest']], function() {
    /**
     * Login Routes
     */
    Route::get('admin-auth/', [AuthController::class, 'show'])->name('admin.login.form');
    Route::post('admin-auth/authenticate/', [AuthController::class, 'login'])->name('user.login');
});

Route::group(['middleware' => 'auth'], function () {

	Route::get('logout', [AuthController::class, 'logout'])->name('user.logout');
	Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('admin/products', [ProductController::class, 'index'])->name('products');
	Route::get('admin/inquiry', [InquiryController::class, 'index'])->name('inquiry');
	Route::get('admin/category', [CategoryController::class, 'index'])->name('category');
	// category
	Route::get('admin/category/list', [CategoryController::class, 'populate'])->name('category.list');
	Route::post('admin/category/store', [CategoryController::class, 'store'])->name('category.store');
	Route::put('admin/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
	Route::delete('admin/category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
	// product
	Route::get('admin/product/list', [ProductController::class, 'populate'])->name('product.list');
	Route::get('admin/product/{product}', [ProductController::class, 'show'])->name('product.show');
	Route::post('admin/product/store', [ProductController::class, 'store'])->name('product.store');
	Route::post('admin/product/set/featured', [ProductController::class, 'setFeaturedProducts'])->name('product.set.featured');
	Route::put('admin/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
	Route::post('admin/product/img/remove', [ProductController::class, 'removeImage'])->name('product.image.remove');
	Route::delete('admin/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
	// inbox
	Route::get('admin/inquiry/list', [InquiryController::class, 'populate'])->name('inquiry.list');
	Route::get('admin/inquiry/{inquiry}', [InquiryController::class, 'show'])->name('inquiry.show');
	Route::delete('admin/inquiry/destroy/{id}', [InquiryController::class, 'destroy'])->name('inquiry.destroy');

});
