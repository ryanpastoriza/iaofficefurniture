<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
// use App\Http\Controllers\Admin\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function username() {
    	return 'username';
	}
	/**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show() {
		return view('admin.auth');
	}

	public function login(Request $request) {
        
    	$credentials = $request->only('username', 'password');

    	if( Auth::attempt($credentials) ) {
			
			if( Auth::user()->status ) {
                 return redirect()->route('dashboard');
			}
    	}

        return back()->with('error', 'The credentials you entered isn’t connected to an account.');
    }

    public function logout() {
        // Session::flush();
        Auth::logout();
        return redirect()->route('admin.login.form');
	}
}
