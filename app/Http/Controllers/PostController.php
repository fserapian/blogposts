<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Http\Requests\StorePost;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        // dd(BlogPost::all());
        return view('posts.index', ['posts' => BlogPost::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        return view('posts.show', ['post' => BlogPost::find($id)]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePost $request)
    {
        $validatedData = $request->validated();

//	    dd($validatedData);
//
//	    $blogPost = new BlogPost();
//		$blogPost->title = $request->input('title');
//		$blogPost->content = $request->input('content');
//
//		$blogPost->save();

        BlogPost::create($validatedData);

        // Flash Message
        $request->session()->flash('status', 'New post created');

        return redirect()->route('posts.index');
    }

    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validatedData = $request->validated();

        $post->fill($validatedData);
        $post->save();

        $request->session()->flash('status', 'Post updated');
        return redirect()->route('posts.edit', ['post' => $post]);
    }

    public function destroy(Request $request, $id) {
        $post = BlogPost::findOrFail($id);
        $post->delete();
        $request->session()->flash('status', 'Post deleted');
        return redirect()->route('posts.index');
    }
}
