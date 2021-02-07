<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use App\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostTagController extends Controller
{
    public function index($tag)
    {
        $tag = Tag::findOrFail($tag);

        return view('posts.index', [
            'posts' => $tag->blogPosts,
        ]);
    }
}
