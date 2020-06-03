@php($i = 0)
@foreach($offers as $offer)
    @if($i >= $number) @break @endif
    @include('partials.product.product_offer_item',['offer' => $offer, 'display'=> $display])
    @php($i++)
@endforeach