<tr>
    <td scope="row" class="border-0 align-middle">
        <div class="p-2">
            <a href="product.php"><img src="../../../public/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage"></a>
            <div class="ml-3 d-inline-block align-middle">
            <h5 class="mb-0"><a href={{url('product/'.$data->offer->product->id)}} class="text-dark d-inline-block">{{$data->offer->product->name}}</a></h5><a href="#" data-toggle="modal" data-target="userFeedback.{{$data->offer->seller->id}}" class="text-muted font-weight-normal font-italic">{{$data->offer->seller->username}}</a>
                @include('partials.feedback',['user'=>$data->offer->seller])
            </div>
        </div>
    </td>
    @include('partials.table.entrydiscount',['data'=>$data->offer])
    <td class="align-middle">
        <div class="btn-group-justified btn-group-md">
            <button class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"> <i class="fa fa-trash cl-fail"></i> <span class="d-none d-md-inline-block">Delete</span></button>
        </div>
    </td>
</tr>