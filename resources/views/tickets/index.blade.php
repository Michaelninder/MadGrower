@extends('layouts.main')

@section('main-content')
    <h1>Support Tickets</h1>
    <p>Welcome to the support ticket system. Here you can view and manage your support tickets.</p>
    <button class="button-primary" onclick="window.location.href='{{ route('tickets.create') }}'">Create New Ticket</button>
@endsection