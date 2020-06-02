<article class="card col-xs-8 col-sm-8 col-md-2 col-lg-2 col-xl-2 mx-auto mx-sm-0 cardHomepage">
    <header>
        <a href="product/{{$card->offer->product->name.'/'.$card->offer->platform['name']}}">
            <img class="card-img-top cardHomepageImg img-fluid" src="{{asset('/pictures/games/'.$card->offer->product->picture->url)}}">
        </a>
    </header>
    <section class="card-body">
        <h6 class="card-title">
            <a href="product/{{$card->offer->product->name.'/'.$card->offer->platform['name']}}" class="text-decoration-none text-secondary">
                {{ucwords(strtolower($card->offer->product->name)).' ['.$card->offer->platform['name'].']'}}
            </a>
        </h6>

        <h5 class="cl-orange2">{{$card->offer->discount_price()}}</h5>
    </section>
</article>