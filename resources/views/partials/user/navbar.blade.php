<ul id="userNavbar" class="nav nav-tabs justify-content-center p-3 flex-nowrap">
    <li class="nav-item">
        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ url('/user/'.$user->username) }}"><button class="btn btnMediaSmall {{ strcasecmp('Account', $active) == 0 ? 'btn-blue-full' : 'btn-blue' }}">Account</button></a>
    </li>
    @if ($isOwner)
    <li class="nav-item">
        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ url('/user/purchases') }}"><button class="btn btnMediaSmall {{ strcasecmp('Purchases', $active) == 0 ? 'btn-blue-full' : 'btn-blue' }}">Purchases</button></a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ url('/user/'.$user->username.'/offers') }}"><button class="btn btnMediaSmall btn-blue {{ strcasecmp('Offers', $active) == 0 ? 'btn-blue-full' : 'btn-blue' }}">Offers</button></a>
    </li>
    @if ($isOwner)
    <li class="nav-item">
        <a class="nav-link deco-none ml-1 mr-1 userNavbarItem" href="{{ url('/user/reports') }}"><button class="btn btnMediaSmall btn-blue {{ strcasecmp('Reports', $active) == 0 ? 'btn-blue-full' : 'btn-blue' }}">Reports</button></a>
    </li>
    @endif
</ul>
