@extends('layout')

@section('content')
<h2>{{ $post->title }}</h2>
<p>{{ $post->content }}</p>
{{-- <small>Published {{ $post->created_at->diffForHumans() }}</small> --}}

    @component('components.badge', ['type'=> 'primary'], ['show' => now()->diffInMinutes($post->created_at) < 20])
        New!
    @endcomponent

    @component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name])
    @endcomponent

    <p>This post has {{ $counter }} views</p>

    <hr>

<h2>Comments</h2>
@forelse ($post->comments as $comment)
<p>{{ $comment->content  }}</p>
{{-- <small class="text-muted">added {{ $comment->created_at->diffForHumans()  }}</small> --}}

    @component('components.updated', ['date' => $comment->created_at])
        Updated
    @endcomponent
<hr>
@empty
<h3 class="text-muted">No comments for the moment...</h3>
@endforelse

@endsection