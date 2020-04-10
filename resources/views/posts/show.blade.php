@extends('layout')

@section('content')
<h2>{{ $post->title }}</h2>
<p>{{ $post->content }}</p>
<small>Published {{ $post->created_at->diffForHumans() }}</small>

@if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 10) <strong>New!</strong>
    @endif
    <hr>

    <h2>Comments</h2>
    @forelse ($post->comments as $comment)
    <p>{{ $comment->content  }}</p>
    <small class="text-muted">added {{ $comment->created_at->diffForHumans()  }}</small>
    <hr>
    @empty
    <h3 class="text-muted">No comments for the moment...</h3>
    @endforelse

    @endsection