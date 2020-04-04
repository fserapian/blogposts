<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {
	public function home() {
//	    dd(Auth::user());
		return view('home');
	}

	public function contact() {
		return view('contact');
	}

	// public function blogPost($id) {
	// 	$pages = [
	// 		1 => [
	// 			'title' => 'First Post',
	// 		],
	// 		2 => [
	// 			'title' => 'Second Post',
	// 		],
	// 	];

	// 	return view('blog-post', ['data' => $pages[$id]]);
	// }
}
