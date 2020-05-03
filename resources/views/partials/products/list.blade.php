<div class="row pt-5">
    @include('partials.products.filter', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
            'min_price' => $min_price, 'max_price' => $max_price])
    @include('partials.products.modal', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
            'min_price' => $min_price, 'max_price' => $max_price])
    <div id="product_list" class="col ml-auto mr-auto">
        @include('partials.products.modal_button')
        <div class="row justify-content-between mx-auto flex-wrap">
            @php($i = 0)
            @foreach($products as $product)
                @if($i === 3 || $i === 6)
        </div>
        <div class="row justify-content-between mx-auto flex-wrap mt-2">
                @endif
                <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                    <a href="#"><img class="card-img-top cardProductListImg img-fluid" src="{{asset('images/games/'.$product->image->url)}}"></a>
                    <div class="card-body">
                        <h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">{{$product->name}}</a></h6>
                        <h5 class="cl-orange2">{{$product->offers->min('price') !== null ? '$'.$product->offers->min('price') : 'Unavailable'}}</h5>
                    </div>
                </div>
                @php($i++)
            @endforeach
        </div>
    </div>
</div>
