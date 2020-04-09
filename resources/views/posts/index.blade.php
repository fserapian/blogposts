@extends('layout')

@section('content')
@forelse ($posts as $post)
{{-- <table>
                <tr>
                    <td>
                        <a href="{{route('posts.show', ['post' => $post->id])}}"><h3>{{$post->title}}</h3></a>
</td>
<td>
    <a href="{{route('posts.edit', ['post' => $post->id])}}">
        <button class="btn btn-info">Edit</button>
    </a>
</td>
<td>
    <form action="{{route('posts.destroy', ['post' => $post->id])}}" method="post">
        @csrf
        @method('delete')
        <input type="submit" value="Delete" class="btn btn-secondary">
    </form>
</td>
</tr>
</table> --}}

<p><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></p>

<small class="text-muted">Added {{ $post->created_at->diffForHumans() }} by {{ $post->user->name }}</small>

@if ($post->comments_count)
<p><small>{{ $post->comments_count }} comments</small></p>
@else
<p><small>No comments here</small></p>
@endif


@can('update')
<a href="{{ route('posts.edit', ['post' => $post->id]) }}">
    <button class="btn btn-info btn-sm">Edit</button>
</a>
@endcan

@can('delete')
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

@endsection