<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Factory|View
	 */
	public function index() {
		// dd(BlogPost::all());
		return view('posts.index', ['posts' => BlogPost::all()]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Factory|View
	 */
	public function show($id) {
		return view('posts.show', ['post' => BlogPost::find($id)]);
	}

	public function create() {
		return view('posts.create');
	}

	public function store(Request $request) {
	    $blogPost = new BlogPost();
		$blogPost->title = $request->input('title');
		$blogPost->content = $request->input('content');

		$blogPost->save();

		return redirect()->route('posts.index');
	}
}
