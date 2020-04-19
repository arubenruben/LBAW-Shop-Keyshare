<nav id="breadcrumbs" class="nav">
    <div id="breadcrumbContainer">
        <ol class="breadcrumb d-inline-flex">
            @foreach($breadcrumbs as $url => $page)
                <li class="breadcrumb-item"><a href="{{ url($url) }}"><i class="fas fa-home"></i>{{ $page }}</a></li>
            @endforeach
            @foreach($active as $url => $page)
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ url($url) }}"><i class="fas fa-home"></i>{{ $page }}</a></li>
            @endforeach
        </ol>
    </div>
</nav>
