<article id="carouselExampleIndicators" class="carousel slide ml-auto mr-auto row mx-3 my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <section class="carousel-inner">
        <div class="carousel-item active">
            <a href="{{url('search')}}"><img src={{$carousel[0]}} class="d-block w-100"></a>
        </div>
        <div class="carousel-item">
        <a href="{{url('search')}}"><img src={{$carousel[1]}} class="d-block w-100"></a>
        </div>
        <div class="carousel-item">
            <a href="{{url('search')}}"><img src={{$carousel[2]}} class="d-block w-100"></a>
        </div>
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