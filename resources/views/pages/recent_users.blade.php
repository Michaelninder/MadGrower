@extends('layouts.main')

@section('main-content')
    Recent Users:
    @forelse($users as $usr)
        <div>
            <img src="{{ $usr->getAvatarUrl(32) }}" alt="{{ $usr->username }}">
            <span>{{ $usr->username }}</span>
            <span>({{ $usr->rank }})</span>
        </div>
    @empty
        NO USERS ...
    @endforelse
@endsection