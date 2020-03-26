<?php

namespace App\Http\Controllers;

class HomeController extends Controller {
	public function home() {
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
