<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends Controller
{
     public function index() {
    	
    	return view('web.contact')->with([
			'title' => 'Contact Us', 
			'segment' => '',
		]);
    }
}
