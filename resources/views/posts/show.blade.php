@extends('layout')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
        {{-- <small>Published {{ $post->created_at->diffForHumans() }}</small> --}}
        
            @component('components.badge', ['type'=> 'primary'], ['show' => now()->diffInMinutes($post->created_at) < 20])
                New!
            @endcomponent
        
            @component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name])
            @endcomponent
        
            <p>This post has {{ $counter }} views</p>
        
            @component('components.tags', ['tags' => $post->tags])@endcomponent
            <hr>

            @auth
                <form action="#">
                    @include('comments._form')
                </form>
            @else
                <a href="{{ route('login') }}">Login</a> to add comments
            @endauth
        
        <h2>Comments</h2>
        @forelse ($post->comments as $comment)
        <p>{{ $comment->content  }}</p>
        {{-- <small class="text-muted">added {{ $comment->created_at->diffForHumans()  }}</small> --}}
        
            @component('components.updated', ['date' => $comment->created_at, 'name' => $comment->user->name])
                Updated
            @endcomponent
        <hr>
        @empty
        <h3 class="text-muted">No comments for the moment...</h3>
        @endforelse
    </div>
    <div class="col-md-4">
        @include('posts._activity')
    </div>
</div>


@endsection