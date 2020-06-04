<article>
    <header class="row">
        <div class="col-8">
            <h5 class="title"> Most Popular
                <a href="{{route('search', ['sort_by' => '3'])}}">
                    <small class="ml-3 d-inline-block"> See all</small>
                </a>
            </h5>
        </div>
        <div class="col-4 d-flex justify-content-end my-auto mw-100 mh-100">
            <a id="left-most-popular" href="#carouselPopular" data-slide="prev"
                class="btn btn-light rounded-circle ml-auto" role="button" onclick="blur();">
                <i class="fas fa-angle-left"></i>
            </a>
            <a id="right-most-popular" href="#carouselPopular" data-slide="next" class="btn btn-light rounded-circle"
                role="button" onclick="blur();">
                <i class="fas fa-angle-right"></i>
            </a>
        </div>
    </header>
    <div class="row">
        <div id="carouselPopular" class="carousel slide mb-5" data-interval="false">
            <div class="carousel-inner">
                @for($i = 0; $i < count($data)/5; $i++)
                    @if($i==0)
                        <div class="carousel-item active  px-3">
                    @else
                    <div class="carousel-item  px-3">
                        @endif
                        <div class="row justify-content-sm-center justify-content-md-between mt-3 mb-3 ml-auto mr-auto">
                            @php($j = 0)
                            @foreach($data as $card)
                                @if($j >= $i*5)
                                    @include('partials.product.product_card', ['card' => $card])
                                @endif
                                @php($j++)
                                @if($j >= $i*5+5)
                                    @break
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</article>