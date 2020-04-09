@extends('layout')

@section('content')

@include('posts._error-message')

<div class="row">
    <div class="col-md-5 mx-auto">
        <form action="{{ route('posts.store') }}" method="post">
            @csrf

            @include('posts._form')

            <button type="submit" class="btn btn-outline-dark btn-block">Add Your Post</button>
        </form>
    </div>
</div>

@endsection