@extends('layouts.main')

@section('main-content')
    <h1>Ticket Details</h1>
    <p><strong>Subject:</strong> {{ $ticket->subject }}</p>
    <p><strong>Status:</strong> {{ $ticket->status }}</p>
    <p><strong>Created At:</strong> {{ $ticket->created_at->format('d M Y H:i') }}</p>

    <h2>Messages</h2>
    @foreach($ticket->messages as $message)
        <div class="ticket-message">
            <p><strong>{{ $message->user->username }}:</strong></p>
            <p>{{ $message->message }}</p>
            <p><em>Posted at {{ $message->created_at->format('d M Y H:i') }}</em></p>
        </div>
    @endforeach
@endsection