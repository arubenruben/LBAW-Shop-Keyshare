<article id="top-page" class="row ml-auto mr-auto">
    <div class="col-5 mt-5  p-0">
        <img class="img-fluid productPageImgPreview" src="{{asset('/pictures/games/'.$product->picture->url)}}" />
    </div>
    <aside class="col-6 mt-5">
        <div class="row">
            <div class="col-12">
                <h3 id="product_name_platform" data-product-name="{{$product->name}}"
                    data-product-platform="{{$platformName}}">{{$product->name}} [{{$platformName}}]</h3>
            </div>
        </div>
        <div class="row  mt-4 mb-4">
            <div class="col-12">
                @if(count($offers)>0)
                <h4 class="title-price d-inline-block">Starting at: {{$offers[0]->discountPriceColumn}}$</h4>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-none d-lg-inline ">
                <p class="text-justify" id="text-readmore">
                    {{substr($product->description, 0 , 200)}} @if(strlen(substr($product->description, 0 , 200)) < 200)
                        ... @endif <span id="dots"></span><span id="more"
                            class="text-justify">{{substr($product->description, 200 , strlen($product->description))}}</span>
                </p><a id="moreTextButton" href="#">Read more</a>
            </div>
        </div>
    </aside>
</article>
<article class="row mt-5" id="offersListing">
    <div class="col-sm-12">
        <div class="row mt-4">
            <div class="col-6">
                <h4>Offers <span id="counter-number-offers" class="badge ml-1 badge-secondary">{{$numberOffers}}</span>
                </h4>
            </div>
            <div id="radio-buttons" class="col-6 text-right {{ count($offers)===0 ? 'd-none': '' }}">
                <h6 class="d-inline-block mr-3">Sort by: </h6>
                <div style='display:inline;' class="mr-3">
                    <input type="radio" style='transform:scale(1.4);' name="sort_by" id="radio_best_price" checked/>
                    <label for="radio_best_price">Best Price</label>
                </div>
                <div style='display:inline;'>
                    <input type="radio" style='transform:scale(1.4);' name="sort_by" id="radio_best_rating"/>
                    <label for="radio_best_rating">Best Rating</label>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12">
                <div id="offers-content" class="table-responsive table-striped ">
                    @if(count($offers)>0)
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
                            @include('partials.product.product_offers',['offers' => $offers, 'number' => 10, 'display'=>true])
                        </tbody>
                    </table>
                    @else
                </div>
                <div class="row mt-5" id="offersListing">
                    <div class="col-sm-12 text-center align-middle">
                        <p class="mt-5">No offers available for this product</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div id="see-more-buttons" class="row mt-4 mx-auto {{$numberOffers > 10 ? '' : 'd-none'}}">
            <div class="col-12">
                <button id="see_more_offers" class="btn btn-blue">
                    <i class="fas fa-angle-down"></i> See the more offers <i class="fas fa-angle-down"></i>
                </button>
                <div id="loading_offers" class="spinner-border text-secondary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <a id="close_more_offers" href="#top-page" class="btn btn-blue" role="button" style="display: none;">
                    <i class="fas fa-angle-up"></i> See first 10 offers <i class="fas fa-angle-up"></i> </a>
            </div>
        </div>
    </div>
</article>