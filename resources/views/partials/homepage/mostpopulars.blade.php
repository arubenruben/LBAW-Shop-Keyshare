<article>
    <header class="row ml-3">
        <div class="col-8 pl-0">
            <h5 class="title"> Most Popular <a href="products_list.php"><small class="ml-3 d-inline-block"> See
                        all</small></a></h5>
        </div>
        <div class="col-4 pl-0 d-flex justify-content-end my-auto mw-100 mh-100">
            <button id="side-btn" type="button" class="btn btn-light rounded-circle" onclick="blur();"><i
                    class="fas fa-angle-left"></i></button>
            <button id="side-btn1" type="button" class="btn btn-light rounded-circle" onclick="blur();"><i
                    class="fas fa-angle-right"></i></button>
        </div>
    </header>
    <div class="col mb-5">
        <article class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto">
            @foreach ($data as $card)
            @include('partials.product.productcard',['card' => $card])
            @endforeach
        </article>
    </div>
</article>