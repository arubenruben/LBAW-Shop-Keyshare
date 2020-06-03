<div class="row pt-5">
    @include('partials.products.filter', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
    'min_price' => $min_price, 'max_price' => $max_price])
    @include('partials.products.modal', ['genres' => $genres, 'platforms' => $platforms, 'categories' => $categories,
    'min_price' => $min_price, 'max_price' => $max_price])
    <section class="col">
        @include('partials.products.modal_button')
        @if(isset($products) and $products != null)
        <div id="product_list" class="col ml-auto mr-auto">
            <div class="row justify-content-between mx-auto flex-wrap">
                @if(sizeof($products) == 0) @include('partials.products.no_results') @endif
                @php($i = 0)
                @foreach($products as $product)
                @if($i % 3 == 0 && $i > 0)
            </div>
            <div class="row justify-content-between mx-auto flex-wrap mt-2">
                @endif
                <div class="card col-md-3 col-sm-4 col-10 cardProductList my-2 mx-auto">
                    <a
                        href="{{route('product', ['productName' => $product->name, 'platformName' => $product->platform])}}">
                        <img class="card-img-top cardProductListImg img-fluid" src="{{ $product->picture }}">
                    </a>
                    <div class="card-body">
                        <h6 class="card-title"><a
                                href="{{route('product', ['productName' => $product->name, 'platformName' => $product->platform])}}"
                                class="text-decoration-none text-secondary">{{$product->name.' ['.$product->platform.']'}}</a>
                        </h6>
                        <h5 class="cl-orange2"> {{'$'.$product->price}} </h5>
                    </div>
                </div>
                @php($i++)
                @endforeach
            </div>
        </div>
        @endif
    </section>
</div>