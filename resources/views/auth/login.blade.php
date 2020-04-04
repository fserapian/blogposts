@extends('layout')

@section('content')

    <form action="{{route('login')}}" method="POST">
        @csrf
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
        <button class="btn btn-outline-primary btn-block">Login</button>
    </form>

@endsection
