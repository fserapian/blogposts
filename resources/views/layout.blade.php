<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog posts</title>
</head>

<body>

<ul>
	<li>
		<a href="{{ route('home') }}">Home</a>
	</li>
	<li>
		<a href="{{ route('contact') }}">Contact</a>
	</li>
	<li>
		<a href="{{ route('posts.index') }}">Blog Posts</a>
	</li>
    <li>
        <a href="{{ route('posts.create') }}">Add new post</a>
    </li>
</ul>

@yield('content')

</body>

</html>
