@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h2>
                {{ $post->title }}
                @if ((new Carbon\Carbon())->diffInDays($post->created_at) < 5)
                    <x-badge type="primary">
                        New!
                    </x-badge>
                @endif
            </h2>
        
            <p>{{ $post->content }}</p>
            {{-- <small>Published {{ $post->created_at->diffForHumans() }}</small> --}}
            
            <x-updated :date="$post->created_at" :name="$post->user->name">
            </x-updated>
            
            <p>This post has {{ $counter }} views</p>
            
            @component('components.tags', ['tags' => $post->tags])@endcomponent
            <hr>

            @auth
                <form action="{{ route('posts.comments.store', ['post' => $post]) }}" method="post">
                    @csrf
                    @include('comments._form')
                </form>
            @else
                <a href="{{ route('login') }}">Login</a> to add comments
            @endauth

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            <x-errors></x-errors>
            
            <h2>Comments</h2>

            @forelse ($post->comments as $comment)
                <p>{{ $comment->content  }}</p>
                {{-- <small class="text-muted">added {{ $comment->created_at->diffForHumans()  }}</small> --}}
            
                <x-updated :date="$comment->created_at" :name="$comment->user->name">
                    Updated
                </x-updated>

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