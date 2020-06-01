<header id="headerFixed" class="navbar row justify-content-between">
    <a href="{{ url('/admin') }}" class="btn btn-outline-light navbarButton d-none d-md-block" role="button">Dashboard</a>
    <a href="{{ url('/admin') }}">
        <img class="img-fluid logo mx-auto" src="{{ asset('/pictures/logo/logo.png') }}"  alt="KeyShare logo">
    </a>
    <form action="{{ url('/admin/logout') }}" method="POST">
        <button type="submit" class="btn btn-outline-light navbarButton" role="button">Logout</button>
    </form>
</header>