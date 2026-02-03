@extends('layouts.main')

@section('main-content')
    <h2>Register</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/register" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required value="{{ old('username') }}">
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </form>

    <hr>

    <div>
        <p>Or sign up with:</p>
        <ul>
            <li><a href="{{ route('auth.redirect', 'github') }}">GitHub</a></li>
            <li><a href="{{ route('auth.redirect', 'discord') }}">Discord</a></li>
            <li><a href="{{ route('auth.redirect', 'twitch') }}">Twitch</a></li>
        </ul>
    </div>
@endsection