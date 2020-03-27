@extends('layout')

@section('content')
	<h1>{{$post->title}}</h1>
	<h3>{{$post->content}}</h3>
	<small>Published {{$post->created_at->diffForHumans()}}</small>

	@if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 10)
		<strong>New!</strong>
	@endif

@endsection
