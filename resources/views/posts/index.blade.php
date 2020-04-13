@extends('layout')

@section('content')

<div class="row">

    <div class="col-md-8">

        @forelse ($posts as $post)
        @if ($post->trashed())
        <del>
            @endif
            <p><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></p>
            @if ($post->trashed())
        </del>
        @endif
        <small class="text-muted">Added {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</small>

        @updated(['date' => $post->created_at, 'name' => $post->user->name])
        @endupdated

        @if ($post->comments_count)
        <p><small>{{ $post->comments_count }} comments</small></p>
        @else
        <p><small>No comments here</small></p>
        @endif

        @auth
            @can('update', $post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}">
                <button class="btn btn-info btn-sm">Edit</button>
            </a>
            @endcan
        @endauth

        @auth
            @if (!$post->trashed())
                @can('delete', $post)
                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post" style="display: inline;">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" class="btn btn-secondary btn-sm">
                </form>
                @endcan
            @endif
        @endauth
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

        {{-- <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Active Users</h5>
                <p class="card-subtitle text-muted">Users with the most posts</p>
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($mostActive as $user)
                <li class="list-group-item">
                    <span>{{ $user->name }}<span> <small>({{ $user->blog_posts_count }} posts)</small>
                </li>
                @endforeach
            </ul>
        </div> --}}

        @component('components.card', ['title' => 'Most Active'])
            @slot('subtitle')
                Users who are most active
            @endslot
            @slot('items', collect($mostActive)->pluck('name'))
        @endcomponent

        
    </div>
</div>

@endsection
