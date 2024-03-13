<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;


class ContactController extends Controller
{
     public function index() {

        $categories = Category::where(['parent_category' => 0])->get();
     	// $breadcrumbs = [
      //       'title' => 'Contact I&A Office Furniture : For more inquiries',
      //       'name' => 'Contact Us',
      //       'items' => [
      //           [
      //               'label' => 'Home',
      //               'url' => route('home'),
      //               'class' => 'crumbs'
      //           ]
      //       ]
      //   ];
    	
    	return view('web.contact')->with([
			'title' => 'Contact I&A Office Furniture : For more inquiries',
            'categories' => $categories
			// 'segment' => '',
			// 'breadcrumbs' => $breadcrumbs
		]);
    }
}
