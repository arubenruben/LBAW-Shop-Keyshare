@extends('layouts.app')

@section('title')Homepage @endsection

@include('partials.header.userheader')

@section('navbar')
@include('partials.navbar.nonavbar',['pages'=>$pages,'links'=>$links])
@endsection

@section('content')
<article>
    <header class="row">
        <div class="col-sm-6 text-left">
            <h4>My Cart<span class="badge badge-secondary">4</span></h4>
        </div>
    </header>
    <section class="row">
        <div class="col-sm-12">
            <div class="table-responsive table-striped  mt-3">
                <table id="userOffersTable" class="table p-0">
                    <thead>
                        <tr>
                            <th scope="col" class="border-0 bg-light">
                                <div class="p-2 px-3 text-uppercase">Product Details</div>
                            </th>                        
                            <th scope="col" class="border-0 bg-light text-center">
                                <div class="py-2 text-uppercase">Price</div>
                            </th>
                            <th scope="col" class="border-0 bg-light text-center">
                                <div class="py-2 text-uppercase">Remove</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            @include('partials.cart.cartentry',['data'=>$item])                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</article>
@endsection

@section('footer')
    @include('partials.footer.userfooter')
@endsection