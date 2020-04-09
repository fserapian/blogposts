@extends('layout')

@section('content')
<h1>Contact Us</h1>
<p>This is the contact page</p>

@can('home.secret')
<a href="{{ route('secret') }}">Go to secret page</a>
@endcan

@endsection