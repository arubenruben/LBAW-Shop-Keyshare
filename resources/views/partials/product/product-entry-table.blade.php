
<tr class="offer {{  $display ? '' : 'offer_outside'}}">
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
    @if($offer->price != $offer->discount_price())
    <td class="text-center align-middle"><del><strong>${{$offer->price}}</strong></del><strong
            class="cl-green pl-2">${{$offer->discount_price()}}</strong></td>
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
                <button id="add_offer_to_cart_{{$offer->id}}"
                    onclick="pressed_add_offer_to_cart({{$offer->id}})" class="btn btn-orange"><i class="fas fa-cart-plus"></i></button>
            @endif
        </div>
    </td>
</tr>