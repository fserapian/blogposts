@extends('layout')

@section('content')

<div class="row">

    <div class="col-md-8">

        @forelse ($posts as $post)
        <p><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></p>
        <small class="text-muted">Added {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</small>

        @if ($post->comments_count)
        <p><small>{{ $post->comments_count }} comments</small></p>
        @else
        <p><small>No comments here</small></p>
        @endif

        @can('update', $post)
        <a href="{{ route('posts.edit', ['post' => $post->id]) }}">
            <button class="btn btn-info btn-sm">Edit</button>
        </a>
        @endcan

        @can('delete', $post)
        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post" style="display: inline;">
            @csrf
            @method('delete')
            <input type="submit" value="Delete" class="btn btn-secondary btn-sm">
        </form>
        @endcan
        <hr>

        @empty
        <h1>No blog posts at the moment</h1>

        @endforelse

    </div>

    <div class="col-md-4">
        <div class="card mb-3" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Most Commented</h5>
                <p class="card-subtitle text-muted">
                    What people are talking about</p>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($mostCommented as $post)
                <li class="list-group-item">
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Active Users</h5>
                <p class="card-subtitle text-muted">Users with the most posts</p>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($activeUsers as $user)
                <li class="list-group-item">
                    <span>{{ $user->name }}<span> <small>({{ $user->blog_posts_count }} posts)</small>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection