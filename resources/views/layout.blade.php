<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>The Blog</title>
</head>

<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">The Blog</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="{{route('home')}}">Home</a>
        <a class="p-2 text-dark" href="{{route('contact')}}">Contact</a>
        <a class="p-2 text-dark" href="{{route('posts.index')}}">Blog Posts</a>
        <a class="p-2 text-dark" href="{{route('posts.create')}}">Add a post</a>
        @guest
            @if (Route::has('register'))
                <a class="p-2 text-dark" href="{{route('register')}}">Register</a>
            @endif
            <a class="p-2 text-dark" href="{{route('login')}}">Login</a>
        @else
            <a href="{{route('logout')}}" id="logout">Logout ({{Auth::user()->email}})</a>
            <form method="POST" action="{{route('logout')}}" id="logout-form" style="display: none">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endguest
    </nav>
</div>

@if (session()->has('status'))
    <h4 style="background: greenyellow; color: black;">
        {{session()->get('status')}}
    </h4>
@endif

<div class="container">
    @yield('content')
</div>

<script src="{{ mix('js/app.js') }}"></body>/script>
</body>

</html>
