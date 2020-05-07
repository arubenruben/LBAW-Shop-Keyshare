@extends('layouts.app')

@section('title')product @endsection

@section('javascript')
    <script src="{{ asset('js/products/product.js') }}" defer></script>
@endsection

@include('partials.header.userheader')

@section('navbar')
    @include('partials.navbar.commercenavbar',['breadcrumbs'=>$breadcrumbs])
@endsection

@section('content')
<article class="row ml-auto mr-auto">
    <div class="col-5 p-0">
        <img class="img-fluid productPageImgPreview" src="/pictures/games/{{$product->picture->url}}"/>
    </div>
    <aside class="col-6">

        <div class="row">
            <div class="col-12">
                <h3>{{$product->name}} [{{$platformName}}]</h3>
            </div>
        </div>

        <div class="row  mt-4 mb-4">
            <div class="col-12">
                @if($offers != null)
                    <h4 class="title-price d-inline-block">Starting at: {{$offers[0]->discountPriceColumn}}$</h4>
            </div>

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
                        @include('partials.product.product-entry-table',['offer'=>$offer])
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
    @include('partials.footer.footer')
@endsection
