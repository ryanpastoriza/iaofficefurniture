<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index() {
    	
    	return view('web.about')->with([
			'title' => 'About Us', 
			'segment' => '',
		]);
    }
}
