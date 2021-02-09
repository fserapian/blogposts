<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function store(BlogPost $post, Request $request)
    {
        $request->validate([
            'content' => 'required|min:3',
        ]);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        $request->session()->flash('success', 'Comment added');

        return redirect()->back();
    }
}
