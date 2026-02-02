<nav class="navbar">
    <img src="{{ asset('assets/img/logo.png') }}" alt="MadGrower Logo" class="logo">

    <ul>
        <li><a class="nav-link" href="{{ route('home') }}">HOME</a></li>
        <li><a class="nav-link"  href="{{ route('pages.home') }}">Home</a></li>
        <li><a class="nav-link"  href="{{ route('pages.lander') }}">Lander</a></li>
        <li><a class="nav-link"  href="{{ route('pages.dashboard') }}">Dashboard</a></li>
    </ul>
</nav>