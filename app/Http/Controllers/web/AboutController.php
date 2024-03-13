<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class AboutController extends Controller
{
    public function index() {

    	$categories = Category::where(['parent_category' => 0])->get();
    	// $breadcrumbs = [
     //        'title' => 'About I&A Office Furniture - Quality Office Furnitures',
     //        'name' => 'About Us',
     //        'items' => [
     //            [
     //                'label' => 'Home',
     //                'url' => route('home'),
     //                'class' => 'crumbs'
     //            ]
     //        ]
     //    ];

    	return view('web.about')->with([
			'title' => 'About I&A Office Furniture - Quality Office Furnitures', 
            'categories' => $categories
			// 'segment' => '',
			// 'breadcrumbs' => $breadcrumbs

		]);
    }
}
