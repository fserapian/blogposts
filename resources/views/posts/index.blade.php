@extends('layout')

@section('content')
	@forelse($posts as $post)
		<h3>
			<a href="{{route('posts.show', ['post' => $post->id])}}">{{$post->title}}</a>
		</h3>

	@empty
		<h1>No blog posts at the moment</h1>

	@endforelse
@endsection