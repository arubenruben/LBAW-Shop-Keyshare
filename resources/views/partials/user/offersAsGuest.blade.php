<div id="content" class="container mt-5">
    <div class="row mt-5">
        <div class="col-sm-12 usercontent-left">
            <div class="row px-3">
                <div class="col-sm-9 " style=" display:flex; align-items: center;">
                    <h4 class="text-left">{{ $user->name}} <span class="badge ml-1 badge-secondary">4</span></h4>
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
                                @foreach($currentOffers as $currentOffer)
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
                                            <a href="{{ url('/product/'.$currentOffer->product()->id.'/'.$currentOffer->platform()->platform_id)}}" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-eye"></i> <span class="d-none d-md-inline-block"> View Offer </span></a>
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
        </div>
    </div>
</div>