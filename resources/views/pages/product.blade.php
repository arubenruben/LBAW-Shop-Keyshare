@extends('layouts.app')

@section('title')product @endsection

@section('javascript')
    <script src="{{ asset('js/product/product.js') }}" defer></script>
@endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.commercenavbar',['pages'=>$pages,'links'=>$links])
@endsection

@section('content')
<article class="row ml-auto mr-auto">
    <div class="col-5 p-0">
        <img class="img-fluid productPageImgPreview" src={{$product->image->url}} />
    </div>
    <aside class="col-6">
        <h3>{{$product->name}} [{{$platformName}}]</h3>
        <span>
            @if($offers != null)
                <h6 class="title-price">Starting at:</h6>
                <h4>US {{$offers[0]->discountPriceColumn}}$</h4>
            @endif
        </span>
        <div class="d-none d-lg-inline">
            <p>
                {{substr($product->description, 0 , 200)}}
                <span id="dots">...</span><span id="more">
                    {{substr($product->description, 200 , strlen($product->description))}}
                </span>
            </p>
            <a id="moreTextButton" href="#">Read more</a>
        </div>
    </aside>
</article>
@if($offers != null)
<article class="row mt-5" id="offersListing">
    <div class="col-sm-12 ">
        <div class="table-responsive table-striped mt-5">
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
                                <h4><a data-toggle="modal" data-target=".bd-modal-lg{{$offer->id}}" href="#"
                                        class="seller" style="color:black">{{$offer->seller->username}}</a></h4>
                                <span class="font-weight-bold cl-success"><i class="fas fa-thumbs-up"></i>
                                    {{ $offer->seller->rating }}</span>
                                | <i class="fas fa-shopping-cart"></i> {{$offer->seller->num_sells}} | Stock:
                                {{$offer->stock}}
                            </div>
                        </td>
                        @if($offer->price != $offer->discountPrice())
                        <td class="text-center align-middle"><del><strong>${{$offer->price}}</strong></del><strong
                                class="cl-green pl-2">${{$offer->discountPrice()}}</strong></td>
                        @else
                        <td class="text-center align-middle"><strong>${{$offer->price}}</strong></td>
                        @endif
                        <td class="text-center align-middle">
                            <div class="btn-group-justified">
                                @if(@$user != null)
                                <button id="add_offer_to_cart_{{$offer->id}}"
                                    onclick="pressed_add_offer_to_cart({{$offer->id}})" class="btn btn-orange"
                                    {{ $user->banned() ? 'disabled' : ''}}><i class="fas fa-cart-plus"></i></button>
                                <!-- para adicionar a cookie, perguntar ao ruben como fez isto -->
                                @else
                                <button class="btn btn-orange"><i class="fas fa-cart-plus"></i></button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="row mt-5" id="offersListing">
                <div class="col-sm-12 text-center align-middle">
                    <p class="mt-5">No offers available for this product</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</article>
@endsection

@section('footer')
    @include('partials.footer.userfooter')
@endsection
