<?php

namespace App\Http\Controllers;

use App\User;
use App\BlogPost;
use Illuminate\View\View;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePost;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\View\Factory;

/*
    [
        'show' => 'view',
        'create' => 'create',
        'store' => 'create',
        'edit' => 'update',
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

        // // Caching the data
        // $mostCommented = Cache::remember('most-commented-blog-post', 60, function () {
        //     return BlogPost::mostCommented()->take(5)->get();
        // });

        // $mostActive = Cache::remember('most-active-users', 60, function () {
        //     User::withMostPosts()->take(5)->get();
        // });

        // $mostActiveLastMonth = Cache::remember('most-active-users-last-month', 60, function () {
        //     User::withMostPostsLastMonth()->take(5)->get();
        // });

        return view('posts.index', [
            'posts' => BlogPost::latest()
                ->withCount('comments')
                ->with('user')
                ->with('tags')
                ->get(),
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

        $blogPost = Cache::remember("blog-post-{$id}", 60, function () use ($id) {
            return BlogPost::with('comments')->with('tags')->with('user')->findOrFail($id);
        });

        // Caching algorithms for visited users counter
        $sessionId = session()->getId();
        $counterKey = "blog-post-counter-{$id}";
        $usersKey = "blog-post-{$id}-users";

        $users = Cache::get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisited) {
            if ($now->diffInMinutes($lastVisited) >= 1) {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisited;
            }
        }

        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::forever($usersKey, $usersUpdate);

        if (Cache::has($counterKey)) {
            Cache::forever($counterKey, 1);
        } else {
            Cache::increment($counterKey, $difference);
        }

        $counter = Cache::get($counterKey);
        return view(
            'posts.show',
            [
                'post' => $blogPost,
                'counter' => $counter,
            ]
        );
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

        //      dd($validatedData);
        //
        //      $blogPost = new BlogPost();
        //      $blogPost->title = $request->input('title');
        //      $blogPost->content = $request->input('content');
        //
        //      $blogPost->save();

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
