<section id="breadcrumbContainer">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i>Home</a></li>
        @foreach($breadcrumbs as $page => $link)
            <li class="breadcrumb-item"><a href="{{ $link }}">{{ $page }}</a></li>
        @endforeach
    </ol>
</section>