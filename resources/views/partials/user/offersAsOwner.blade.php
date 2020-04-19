<div id="content" class="container mt-5">
    <div class="row">
        <div class="col-sm-12 usercontent-left">
            @if($user->banned())
            <div class="row mb-2">
                <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
                    You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
                </div>
            </div>
            @endif
            <div class="row px-3">
                <div class="col-sm-9 " style=" display:flex; align-items: center;">
                    <h4 class="text-left">Current Offers<span class="badge ml-1 badge-secondary"> {{$currOffers->count()}}</span></h4>
                </div>
                <div class="col-sm-3">
                    <a href="{{url('user/'.$user->id.'/offer')}}" class="btn p-2 btn-sm btn-orange btn-block text-white {{ $user->banned() ? 'disabled' : ''}}" role="button"> <i class="mr-1 fas fa-plus"></i> <span class="d-none d-md-inline-block"> Add offer </span></a>
                </div>
            </div>

            <div class="container mt-3 mb-3">
                <div class="row ">
                    <div class="col-12">
                        <div class="table-responsive table-striped tableFixHead mt-3">
                            <table id="userOffersTable" class="table p-0">
                                <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product Details</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light text-center">
                                        <div class="py-2 text-uppercase">Start Date</div>
                                    </th>

                                    <th scope="col" class="border-0 bg-light text-center">
                                        <div class="py-2 text-uppercase">Current Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light text-center">
                                        <div class="py-2 text-uppercase">Options</div>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($currOffers as $currentOffer)
                                <tr>
                                    <th scope="row" class="border-0 align-middle">
                                        <div class="p-2">
                                            <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                            <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                <h5 class="mb-0 d-inline-block"><a href="product.php" class="text-dark">{{$currentOffer->product()->name}}</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [{{$currentOffer->platform()->name}}]]</span>
                                                <h6>Stock: {{$currentOffer->offer_stock}} keys</h6>
                                            </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                        </div>
                                    </th>
                                    <td class="text-center align-middle">{{$currentOffer->start_date}}</td>
                                    <td class="text-center align-middle"><strong>${{$currentOffer->offer_price}}</strong></td>
                                    <td class="align-middle">
                                        <div class="btn-group-justified btn-group-md">
                                            <a href="{{ url('/user/'.$user->id.'/offer/'.$currentOffer->id) }}" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Offer </span></a>
                                            <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport"><i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Offer </span></button>
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
            <div class="col-sm-12 usercontent-left mt-5">
                <div class="row px-3">
                    <div class="col-sm-12">
                        <h4 class="text-left">Past Offers <span class="badge ml-1 badge-secondary"> {{$pastOffers->count()}}</span></h4>
                    </div>
                </div>
                <div class="container mt-3 mb-3">
                    <div class="row ">
                        <div class="col-12">
                            <div class="table-responsive table-striped tableFixHead mt-3 mt-3">
                                <table id="userOffersTable" class="table p-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="border-0 bg-light">
                                                <div class="p-2 px-3 text-uppercase">Product Details</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Start Date</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">End Date</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Last Price</div>
                                            </th>
                                            <th scope="col" class="border-0 bg-light text-center">
                                                <div class="py-2 text-uppercase">Profit</div>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pastOffers as $pastOffer)
                                    <tr>
                                        <th scope="row" class="border-0 align-middle">
                                            <div class="p-2">
                                                <img src="{{asset('images/games/'.$pastOffer->product()->image()->url)}}" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                    <h5 class="mb-0 d-inline-block"><a href="#" class="text-dark">{{$pastOffer->product()->name}}</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [PS4]</span>
                                                    <h6>Keys sold: {{$pastOffer->keys().count()}}</h6>
                                                </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                            </div>
                                        </th>
                                        <td class="text-center align-middle">{{$pastOffer->start_date}}</td>
                                        <td class="text-center align-middle">{{$pastOffer->end_date}}</td>
                                        <td class="text-center align-middle">{{$pastOffer->price}}</td>
                                        <td class="text-center align-middle"><strong>200</strong></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>