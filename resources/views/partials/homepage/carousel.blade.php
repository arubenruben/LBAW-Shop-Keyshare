<article id="carouselExampleIndicators" class="carousel slide ml-auto mr-auto row mx-3 my-5" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i = 0; $i < count($carousel); $i++)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" class="{{$i == 0 ? 'active' : ''}}"></li>
        @endfor
    </ol>
    <section class="carousel-inner">
        @for($i = 0; $i < count($carousel); $i++)
            <div class="carousel-item {{$i == 0 ? 'active' : ''}}">
                <a href="{{route('search')}}"><img src="{{$carousel[$i]}}" class="d-block w-100" alt="Carousel Image"></a>
            </div>
        @endfor
    </section>
    <a id="carouselArrowLeft" class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
       data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a id="carouselArrowRight" class="carousel-control-next" href="#carouselExampleIndicators" role="button"
       data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</article>