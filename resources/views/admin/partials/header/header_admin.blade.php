<header id="headerFixed" class="navbar row justify-content-between">
    <a href={{ route('admin_homepage') }} class="btn btn-outline-light navbarButton d-none d-md-block"
        role="button">Dashboard</a>
    <a href={{ route('admin_homepage') }}>
        <img class="img-fluid logo mx-auto" src={{ asset('/pictures/logo/logo.png') }} />
    </a>
    <form action="{{ url('/admin/logout') }}" method="POST">
        <button type="submit" class="btn btn-outline-light navbarButton" role="button">Logout</button>
    </form>
</header>