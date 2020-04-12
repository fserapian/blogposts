<?php

namespace App\Http\Controllers;

use App\User;
use App\BlogPost;
use Illuminate\View\View;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\View\Factory;

/*
    [
        'show' => 'view',
        'create' => 'create',
        'store' => 'create',
        'edit' => 'update' 
        'update' => 'update',
        'destroy' => 'delete'
    ]
*/

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        //        DB::connection()->enableQueryLog();
        //
        //        $posts = BlogPost::with('comments')->get();
        //
        //        foreach ($posts as $post) {
        //            foreach ($post->comments as $comment) {
        //                echo $comment->content . "\n ";
        //            }
        //        }
        //
        //        dd(DB::getQueryLog());

        return view('posts.index', [
            'posts' => BlogPost::latest()->withCount('comments')->get(),
            'mostCommented' => BlogPost::mostCommented()->take(5)->get(),
            'mostActive' => User::withMostPosts()->take(5)->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Factory|View
     */
    public function show($id)
    {
        // return view('posts.show', ['post' => BlogPost::with(['comments' => function ($query) {
        //     $query->latest();
        // }])->findOrFail($id)]);

        return view('posts.show', ['post' => BlogPost::with('comments')->findOrFail($id)]);
    }

    public function create()
    {
        // $this->authorize('posts.create');
        return view('posts.create');
    }

    public function store(StorePost $request)
    {
        $validatedData = $request->validated();
        $validatedData['user_id'] = $request->user()->id;

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
        $this->authorize($post);

        return view('posts.edit', ['post' => $post]);
    }

    public function update(StorePost $request, $id)
    {

        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('update-post', $post)) {
        //     abort(403, 'You cannot update this post');
        // }
        $this->authorize($post);

        $validatedData = $request->validated();

        $post->fill($validatedData);
        $post->save();

        $request->session()->flash('status', 'Post updated');
        return redirect()->route('posts.edit', ['post' => $post]);
    }

    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);

        // if (Gate::denies('delete-post', $post)) {
        //     abort(403, 'You cannot delete this post');
        // }
        $this->authorize($post);

        $post->delete();
        $request->session()->flash('status', 'Post deleted');
        return redirect()->route('posts.index');
    }
}
