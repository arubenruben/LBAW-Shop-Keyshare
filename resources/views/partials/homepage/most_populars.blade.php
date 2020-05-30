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
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <article class="row most-popular justify-content-between flex-nowrap mt-2 ml-auto mr-auto">
                        @php $i=0; @endphp
                        @foreach ($data as $card)
                            @if($i <= 4) @include('partials.product.product_card', ['card' => $card])
                            @else
                            @endif

                            @php $i++; @endphp
                        @endforeach
                    </article>
                </div>
                <div class="carousel-item">
                    <article class="row most-popular justify-content-between flex-nowrap mt-2 ml-auto mr-auto">
                        @php $i=0; @endphp
                        @foreach ($data as $card)
                            @if($i > 4) @include('partials.product.product_card', ['card' => $card]) @endif
                            @php $i++; @endphp
                        @endforeach
                    </article>
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
    </div>
</article>