@extends('layout')

@section('content')
    @forelse ($posts as $post)
            <table>
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
            </table>

            @if ($post->comments_count)
                <p>{{$post->comments_count}} comments</p>
            @else
                <p>No comment at the moment</p>
            @endif
     @empty
        <h1>No blog posts at the moment</h1>

    @endforelse
@endsection
