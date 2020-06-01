<article>
    <header class="row ml-3">
        <div class="col-8 pl-0">
            <h5 class="title"> Most Popular
                <a href="{{route('search', ['sort_by' => 'Most popular'])}}">
                    <small class="ml-3 d-inline-block"> See all</small>
                </a>
            </h5>
        </div>
        <div class="col-4 pl-0 d-flex justify-content-end my-auto mw-100 mh-100">
            <a id="left-most-popular" class="btn btn-light rounded-circle carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <i class="fas fa-angle-left"></i>
            </a>
            <a id="right-most-popular" class="btn btn-light rounded-circle carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
    </header>
    <div class="col mb-5">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <article class="row most-popular justify-content-between flex-nowrap mt-2 ml-auto mr-auto">
                        @php $i=0; @endphp
                        @foreach ($data as $card)
                            @if($i <= 4) @include('partials.product.product_card', ['card' => $card]) @endif
                            @php $i++; @endphp
                        @endforeach
                    </article>
                </div>
                <div class="carousel-item">
                    <article class="row most-popular justify-content-between flex-nowrap mt-2 ml-auto mr-auto">
                        @php $i=0; @endphp
                        @foreach ($data as $card)
                            @if($i > 2) @include('partials.product.product_card', ['card' => $card]) @endif
                            @php $i++; @endphp
                        @endforeach
                    </article>
                </div>
            </div>
        </div>
    </div>
</article>