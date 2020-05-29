<tr id={{'row'.$data->id}}>
    <td scope="row" class="border-0 align-middle">
        <section class="p-2">
            <a href="product/{{$data->offer->product->name.'/'.$data->offer->platform->name}}">
                <img src={{ asset('/pictures/games/'.$data->offer->product->picture->url) }} alt="" width=" 150"
                    class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage"></a>
            <section class="ml-3 d-inline-block align-middle">
                <h5 class="mb-0"><a href="product/{{$data->offer->product->name.'/'.$data->offer->platform->name}}"
                        class=" text-dark d-inline-block">{{$data->offer->product->name}}</a></h5><a href="#"
                    data-toggle="modal" data-target="#user-{{$data->offer->seller->id}}"
                    class="text-muted font-weight-normal font-italic">{{$data->offer->seller->username}}</a>
                @include('partials.feedback.feedback',['seller'=>$data->offer->seller])
            </section>
        </section>
    </td>
    @include('partials.table.entry_discount',['data'=>$data->offer])
    <td class="align-middle">
        <section class="btn-group-justified btn-group-md">
            <button class="btn btn-red btn-block flex-nowrap remove_cart_button"
                value_offer={{$data->offer->discountPriceColumn}} data_cart_id={{$data->id}}><i
                    class="fa fa-trash cl-fail"></i> <span class="d-none d-md-inline-block">Delete</span></button>
        </section>
    </td>
</tr>