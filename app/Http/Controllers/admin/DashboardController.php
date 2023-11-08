<?php

namespace App\Http\Controllers\admin;

// use App\Http\Controllers\Controller;
use App\Http\Controllers\admin\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{

    public function index() {
    	return view('admin.dashboard')->with([
    		'title' => 'Dashboard',
    		'segment' => 'dashboard'
    	]);
    }
}
