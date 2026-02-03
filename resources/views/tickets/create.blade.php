@extends('layouts.main')

@section('main-content')
    <form action="{{ route('tickets.store') }}" method="POST">
        @csrf
        <div>
            <label for="subject">Subject:</label>
            <input type="text" name="subject" id="subject" required value="{{ old('subject') }}">
        </div>

        <div>
            <label for="message">Message:</label>
            <textarea name="message" id="message" required>{{ old('message') }}</textarea>
        </div>

        <div>
            <button type="submit">Create Ticket</button>
        </div>

    </form>
@endsection