<nav id="navbar" class="nav">
    @include('partials.navbar.breadcrumbs',['breadcrumbs'=>$breadcrumbs])
    <ul id="userNavbar" class="nav nav-tabs ml-auto mr-auto p-3 flex-nowrap">
        <li class="nav-item">
            <a class="nav-link deco-none ml-1 mr-1 userNavbarItem"
                href="{{ route('profile', ['username' => $user->username])}}"><button
                    class="btn btnMediaSmall {{ strcasecmp('Account', $active) == 0 ? 'btn-blue-full' : 'btn-blue' }}">Account</button></a>
        </li>
        @if ($isOwner)
        <li class="nav-item">
            <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ route('userPurchases') }}"><button
                    class="btn btnMediaSmall {{ strcasecmp('Purchases', $active) == 0 ? 'btn-blue-full' : 'btn-blue' }}">Purchases</button></a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link deco-none ml-1 mr-1 userNavbarItem"
                href="{{ route('userOffers', ['username' => $user->username]) }}"><button
                    class="btn btnMediaSmall btn-blue {{ strcasecmp('Offers', $active) == 0 ? 'btn-blue-full' : 'btn-blue' }}">Offers</button></a>
        </li>
        @if ($isOwner)
        <li class="nav-item">
            <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ route('userReports') }}"><button
                    class="btn btnMediaSmall btn-blue {{ strcasecmp('Reports', $active) == 0 ? 'btn-blue-full' : 'btn-blue' }}">Reports</button></a>
        </li>
        @endif
    </ul>
</nav>