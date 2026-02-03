@extends('layouts.main')

@section('main-content')
    Recent Users:
    <div class="users-grid-container">
        @forelse($users as $usr)
            <div class="user-item">
                <img src="{{ $usr->getAvatarUrl(16) }}" alt="{{ $usr->username }}" class="user-avatar">
                <span class="user-username">{{ $usr->username }}</span>
                <span class="user-rank rank-{{ $usr->rank }}">({{ $usr->rank }})</span>
            </div>
        @empty
            <p>NO USERS ...</p>
        @endforelse
    </div>
@endsection