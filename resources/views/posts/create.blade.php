@extends('layout')

@section('content')

    <form action="{{route('posts.store')}}" method="post">
        @csrf
        <label for="title">Title</label><br>
        <input type="text" id="title" name="title"><br>

        <label for="content">Content</label><br>
        <input type="text" id="content" name="content"><br>

        <button type="submit">Submit</button>
    </form>

@endsection
