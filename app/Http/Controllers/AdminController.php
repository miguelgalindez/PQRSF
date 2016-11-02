<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct(){		
		$this->middleware('auth');
		$this->middleware('admin');		

/*
		$this->middleware('log')->only('index');
        $this->middleware('subscribed')->except('store');

*/

	}


    public function index(){
        return view('admin.index');
    }
}
