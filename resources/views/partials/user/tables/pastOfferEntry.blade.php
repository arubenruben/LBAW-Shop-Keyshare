<tr>
    <td scope="row" class="border-0 align-middle">
        <section class="p-2">
            <img src={{ asset('/pictures/games/'.$pastOffer->product->picture->url) }} alt="" width=" 150"
                class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
            <div class="ml-3 d-inline-block align-middle flex-nowrap">
                <h5 class="mb-0 d-inline-block"><a
                        href="{{'/product/'.$pastOffer->product->name.'/'.$pastOffer->platform->name}}"
                        class="text-dark">{{$pastOffer->product->name}}</a></h5>
                <span class="text-muted font-weight-normal font-italic d-inline-block">
                    [{{$pastOffer->platform->name}}]</span>
                <h6>Keys sold: {{count($pastOffer->keys)}}</h6>
            </div>
            <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
        </section>
    </td>
    <td class="text-center align-middle">{{$pastOffer->init_date}}</td>
    <td class="text-center align-middle">{{$pastOffer->final_date}}</td>
    <td class="text-center align-middle">{{$pastOffer->price}}</td>
    <td class="text-center align-middle"><strong>{{$pastOffer->profit}}</strong>
    </td>
</tr>