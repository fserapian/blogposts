<?php

namespace App\Http\Controllers;

use App\BlogPost;

class PostController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		// dd(BlogPost::all());
		return view('posts.index', ['posts' => BlogPost::all()]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		// dd(BlogPost::find($id));
		return view('posts.show', ['post' => BlogPost::find($id)]);
	}
}
