<ul id="userNavbar" class="nav nav-tabs justify-content-center p-3 flex-nowrap">
    <li class="nav-item">
        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ url('/user/'.$user->name) }}"><button class="btn btnMediaSmall btn-blue-full {{ 'Account' == $active ? 'active' : '' }}">Account</button></a>
    </li>
    @if ($canEdit)
    <li class="nav-item">
        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ url('/user/purchases') }}"><button class="btn btnMediaSmall btn-blue {{ 'Purchases' == $active ? 'active' : '' }}">Purchases</button></a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ url('/user/'.$user->name.'/offers') }}"><button class="btn btnMediaSmall btn-blue {{ 'Offers' == $active ? 'active' : '' }}">Offers</button></a>
    </li>
    @if ($canEdit)
    <li class="nav-item">
        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ url('/user/reports') }}"><button class="btn btnMediaSmall btn-blue {{ 'Reports' == $active ? 'active' : '' }}">Reports</button></a>
    </li>
    @endif
</ul>
