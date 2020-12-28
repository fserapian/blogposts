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

        @component('components.updated', ['date' => $post->created_at, 'name' => $post->user->name])
            Updated
        @endcomponent

        @component('components.tags', ['tags' => $post->tags])
        @endcomponent

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
        @include('posts._activity')
    </div>
</div>

@endsection
