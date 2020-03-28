@extends('layout')

@section('content')

    @include('posts._error-message')

    <form action="{{route('posts.store')}}" method="post">
        @csrf

        @include('posts._form')

        <button type="submit" class="btn btn-outline-dark btn-block">Add Your Post</button>
    </form>

@endsection
