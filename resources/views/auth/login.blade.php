@extends('layouts.main')

@section('main-content')
    <h2>Login</h2>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 1rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/login" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required value="{{ old('email') }}">
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    <hr>

    <div>
        <p>Or login with:</p>
        <ul>
            <li><a href="{{ route('auth.redirect', 'github') }}">GitHub</a></li>
            <li><a href="{{ route('auth.redirect', 'discord') }}">Discord</a></li>
            <li><a href="{{ route('auth.redirect', 'twitch') }}">Twitch</a></li>
        </ul>
    </div>

    <p>Don't have an account? <a href="/register">Register here</a>.</p>
@endsection