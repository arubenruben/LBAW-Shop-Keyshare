<article class="row ml-auto mr-auto">
    <div class="col-5 p-0">
        <img class="img-fluid productPageImgPreview" src="/pictures/games/{{$product->picture->url}}" />
    </div>
    <aside class="col-6">
        <div class="row">
            <div class="col-12">
                <h3 id="product_name_platform" data_product_name="{{$product->name}}"
                    data_product_platform="{{$platformName}}">{{$product->name}} [{{$platformName}}]</h3>
            </div>
        </div>
        <div class="row  mt-4 mb-4">
            <div class="col-12">
                @if($offers != null)
                <h4 class="title-price d-inline-block">Starting at: {{$offers[0]->discountPriceColumn}}$</h4>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-none d-lg-inline ">
                <p class="text-justify">
                    {{substr($product->description, 0 , 200)}}
                    <span id="dots">...</span><span id="more" class="text-justify">
                        {{substr($product->description, 200 , strlen($product->description))}}
                    </span>
                </p>
                <a id="moreTextButton" href="#">Read more</a>
            </div>
        </div>
    </aside>
</article>
<article class="row mt-5" id="offersListing">
    <div class="col-sm-12 ">
        <div class="row mt-4">
            <div class="col-6">
                <h4>Offers <span class="badge ml-1 badge-secondary">{{count($offers)}}</span></h4>
            </div>
            <div class="col-6 text-right">
                <h6 class="d-inline-block mr-3">Sort by: </h6>
                <div class="custom-control custom-radio my-2 ml-3" style="display:inline;">
                    <input type="radio" class="custom-control-input sort-by" id="SortBy1" name="sort_by"
                        value="Best Price">
                    <label class="custom-control-label" for="SortBy1">Best Price</label>
                </div>
                <div class="custom-control custom-radio my-2 ml-3" style="display:inline;">
                    <input type="radio" class="custom-control-input sort-by" id="SortBy2" name="sort_by"
                        value="Best Rating">
                    <label class="custom-control-label" for="SortBy2">Best Rating</label>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div class="table-responsive table-striped ">
                    @if($offers != null)
                    <table id="userOffersTable" class="table p-0">
                        <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Seller Details</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-2 text-uppercase">Price</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-3 text-uppercase"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="offers_body">
                            @php $i = 0; @endphp
                            @foreach($offers as $offer)
                            @if($i < 10) @include('partials.product.product_offer_item',['offer'=>$offer, 'display' =>
                                true])
                                @include('partials.feedback.feedback', ['seller' => $offer->seller])
                                @elseif($i >= 10)
                                @include('partials.product.product_offer_item',['offer'=>$offer, 'display' => false])
                                @endif
                                @php $i++; @endphp
                                @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="row mt-5" id="offersListing">
                        <div class="col-sm-12 text-center align-middle">
                            <p class="mt-5">No offers available for this product</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @if(count($offers) > 9)
        <div class="row mt-4 mx-auto">
            <div class="col-12">
                <button id="see_more_offers" class="btn-blue btn-primary"><i class="fas fa-angle-down"></i> See the
                    other offers <i class="fas fa-angle-down"></i> </button>
                <button id="close_more_offers" class="btn-blue btn-primary" style="display: none;"> <i
                        class="fas fa-angle-up"></i> Only see 10 offers <i class="fas fa-angle-up"></i> </button>
            </div>
        </div>
        @endif
    </div>
</article>