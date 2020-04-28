<div id="content" class="container pt-4">
    <div class="row ml-auto mr-auto">
        <div class="col-5 p-0">
            <img class="img-fluid productPageImgPreview" src={{$product->image->url}}/>
        </div>
        <div class="col-6">
            <h3>{{$product->name}}</h3>
            <span>
                    <h6 class="title-price">Starting at:</h6>
                    <h4>US$ {{$product->offers->where()</h4>
                </span>
            <div class="d-none d-lg-inline">
                <p>
                    {{substr($product->description, 0 , 200)}}<span id="dots" class="collapse show demo1">...</span><span id="extraText"class="collapse demo1">
                        {{substr($product->description, 200 , strlen($product->description)}}
                    </span>
                </p>

                <a href="#" role="button" data-toggle="collapse" data-target=".demo1" aria-expanded="true" aria-controls="dots extraTest more less">
                    <span id="more" class="collapse show demo1">Read more</span><span id="less"class="collapse demo1">Show less</span>
                </a>
            </div>
        </div>
        <div class="col-lg-6 col-0"></div>
    </div>
    <div class="row" id="offersListing">
        <div class="col-sm-12">
            <div class="table-responsive table-striped mt-3">
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
                    <tbody>
                    @foreach($offers as $offer)
                        <tr class="offer">
                            <td scope="row" class="border-0 align-middle">
                                <div class="p-2 m-0">

                                    <h4><a data-toggle="modal" data-target=".bd-modal-lg{{$offer->id}}" href="#" class="seller" style="color:black">{{$offer->seller->username}}</a></h4>
                                    <span class="font-weight-bold cl-success"><i class="fas fa-thumbs-up"></i> {{ $offer->seller->rating }}</span>
                                    | <i class="fas fa-shopping-cart"></i> {{$offer->seller->num_sells}} | Stock: {{$offer->stock}}
                                </div>
                            </td>
                            <td class="text-center align-middle"><strong>${{$offer->discountPrice}}</strong></td>
                            <td class="text-center align-middle">
                                <div class="btn-group-justified">
                                    <button class="btn btn-orange" data-container="body" data-toggle="popover" data-trigger="focus" title="<span class='cl-success'>Successfully added to your cart</span>" data-placement="bottom" data-content="Click <a href='cart.php'>here</a> to go to your cart"><i class="fas fa-cart-plus"></i></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
