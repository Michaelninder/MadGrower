<nav class="navbar">
    <img src="{{ asset('assets/img/logo.png') }}" alt="MadGrower Logo" class="logo">

    <ul>
        <li><a class="nav-link" href="{{ route('pages.home') }}">Home</a></li>
        <li><a class="nav-link" href="{{ route('pages.lander') }}">Lander</a></li>
        <li><a class="nav-link" href="{{ route('pages.recent_users') }}">Recent Users</a></li>

        @auth
            <li><a class="nav-link" href="{{ route('pages.dashboard') }}">Dashboard</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link" style="background:none; border:none; cursor:pointer;">Logout</button>
                </form>
            </li>
        @else
            <li><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            <li><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        @endauth
    </ul>
</nav>