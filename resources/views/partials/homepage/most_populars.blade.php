<article>
    <header class="row ml-3">
        <div class="col-8 pl-0">
            <h5 class="title"> Most Popular
                <a href="{{route('search', ['sort_by' => 'Most popular'])}}">
                    <small class="ml-3 d-inline-block"> See all</small>
                </a>
            </h5>
        </div>
    </header>
    <div class="col mb-5">
        <article class="row most-popular justify-content-between flex-nowrap mt-2 ml-auto mr-auto">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @php $i=0; @endphp
                    @foreach ($data as $card)
                        @if($i==0) <div class="carousel-item active">
                        @elseif ($i%5 == 0) </div> <div class="carousel-item"> @endif
                        @include('partials.product.product_card', ['card' => $card])
                        @php $i++; @endphp
                    @endforeach
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </article>
    </div>
</article>