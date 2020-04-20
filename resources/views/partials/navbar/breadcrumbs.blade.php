<section id="breadcrumbContainer">
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/"><i class="fas fa-home"></i>Home</a></li>
    @foreach ($page as $entry)
        <li class="breadcrumb-item"><a href="{{$url}}">{{$entry}}</a></li>
    @endforeach
    </ol>
</section>