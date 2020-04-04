@extends('layout')

@section('content')

    <form action="{{route('register')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input id="name" type="text" name="name" value="{{old('name')}}"
                   class="form-control {{$errors->has('name') ? 'is-invalid' : null}}">
            @if ($errors->has('name'))
                <div class="invalid-feedback">
                    {{$errors->first('name')}}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="{{old('email')}}"
                   class="form-control {{$errors->has('email') ? 'is-invalid' : null}}">
            @if ($errors->has('email'))
                <div class="invalid-feedback">
                    {{$errors->first('email')}}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password"
                   class="form-control {{$errors->has('password') ? 'is-invalid' : null}}">
            @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{$errors->first('password')}}
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" class="form-control">
        </div>
        <button class="btn btn-outline-primary btn-block">Register</button>
    </form>

@endsection
