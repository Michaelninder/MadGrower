@extends('layouts.app')

@section('content')
@include('components.navbar')
<main>
    @yield('main-content')
</main>
@include('components.footer')
@endsection