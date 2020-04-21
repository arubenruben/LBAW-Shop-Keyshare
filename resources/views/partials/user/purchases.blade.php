<div id="content" class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            @if($user->banned())
                <div class="row mb-2">
                    <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
                        You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
                    </div>
                </div>
            @endif
            <div class="row ">
                <div class="col-sm-12">
                    @php
                    $numberOfPurchases = 0;
                    @endphp
                    @foreach($orders as $order)
                        @php
                        $numberOfPurchases += $order->keys()->getResults()->count()
                        @endphp
                    @endforeach
                    <h4 class="text-left">Purchase History <span class="badge ml-1 badge-secondary">{{$numberOfPurchases}}</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive table-striped tableFixHead mt-3">
                        <table id="userOffersTable" class="table p-0">
                            <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light">
                                    <div class="p-2 px-3 text-uppercase">Product Details</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-2 text-uppercase">Date</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-2 text-uppercase">Price</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-2 text-uppercase">Options</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @foreach($order->keys()->getResults() as $key)
                                        <tr>
                                            <td scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="{{$key->offer()->getResults()->product()->getResults()->image()->getResults()->url}}" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <h5 class="mb-0 d-inline-block"><a href="{{url("/product/".$key->offer()->getResults()->product()->getResults()->id."/".$key->offer()->getResults()->platform()->getResults()->id)}}" class="text-dark">{{$key->offer()->getResults()->product()->getResults()->name}}</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [{{$key->offer()->getResults()->platform()->getResults()->name}}]</span>
                                                        <a href="{{url("/user/".$key->offer()->getResults()->seller()->getResults()->username)}}" ><span class="text-muted font-weight-normal font-italic d-block">{{$key->offer()->getResults()->seller()->getResults()->username}}</span> </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">{{$order->date}}</td>
                                            <td class="text-center align-middle"><strong>{{$key->price_sold}}€</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalSeeKey{{$key->id}}"><i class="fas fa-key d-inline-block"></i> <span class="d-none d-md-inline-block"> See key </span></button>
                                                    @if($user->feedback()->getResults()->where("key", "=", $key->id)->count() == 0)
                                                        <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal" data-target="#modalGiveFeedback{{$key->id}} {{ $user->banned() ? 'disabled' : ''}}"> <i class="far fa-comment-alt d-inline-block"></i> <span class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                    @endif
                                                    @if($key->report()->getResults() == null)
                                                        <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#modalReport{{$key->id}}" {{ $user->banned() ? 'disabled' : ''}} > <i class="fas fa-user-slash d-inline-block"></i> <span class="d-none d-md-inline-block"> Report Seller </span></button>
                                                    @else
                                                        <a href="{{ url('/report/'.$key->report()->getResults()->id) }}" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <div id="modalGiveFeedback{{$key->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header row mx-0">
                                                        <div class="col-9 col-md-6">
                                                            <span class="flex-nowrap"> <i class="far fa-comment-alt d-inline-block"></i><h5 class="d-inline-block">Leave feedback </h5></span>
                                                        </div>
                                                        <div class="col-9 col-md-6 text-right">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div id="reportBorderInfo" class="col-6 text-left">
                                                                <u>
                                                                    <h5>Seller's Info</h5>
                                                                </u>
                                                                <h6>{{$key->offer()->getResults()->seller()->getResults()->username}}</h6>
                                                                <p><i class="fas fa-thumbs-up cl-success"></i><span class="font-weight-bold cl-success">{{$key->offer()->getResults()->seller()->getResults()->rating}}%</span> | <i class="fas fa-shopping-cart"></i> {{$key->offer()->getResults()->seller()->getResults()->num_sells}} </p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <u>
                                                                    <h5>Product in question</h5>
                                                                </u>
                                                                <h6>Order Nº {{$order->number}}</h6>
                                                                <h6>Price : {{$key->price}}€ </h6>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row mt-1">
                                                            <div class="col-6 text-center">
                                                                <button class="btn btn-outline-success btn-lg px-5">
                                                                    <i class="fas fa-thumbs-up cl-success"></i>
                                                                </button>
                                                            </div>
                                                            <div class="col-6 text-center">
                                                                <button class="btn btn-red btn-lg px-5">
                                                                    <i class="fas fa-thumbs-down cl-fail"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col">
                                                                <h6>Comment</h6>
                                                                <textarea class="form-control userDetailsForm mt-2" id="exampleFormControlTextarea1" placeholder="Describe your experience with this seller" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col text-right"><button class="btn btn-blue"> Submit</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="modalReport{{$key->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header row mx-0">
                                                        <div class="col-9 col-md-6">
                                                            <span class="flex-nowrap"> <i class="fas fa-user-slash d-inline-block"></i><h5 class="d-inline-block">Report Seller </h5></span>
                                                        </div>
                                                        <div class="col-9 col-md-6 text-right">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div id="reportBorderInfo" class="col-6 text-left">
                                                                <u>
                                                                    <h5>Seller's Info</h5>
                                                                </u>
                                                                <h6>{{$key->offer()->getResults()->seller()->getResults()->username}}</h6>
                                                                <p><i class="fas fa-thumbs-up cl-success"></i><span class="font-weight-bold cl-success">{{$key->offer()->getResults()->seller()->getResults()->rating}}%</span> | <i class="fas fa-shopping-cart"></i> {{$key->offer()->getResults()->seller()->getResults()->num_sells}} </p>
                                                            </div>
                                                            <div class="col-6 text-right">
                                                                <u>
                                                                    <h5>Product in question</h5>
                                                                </u>
                                                                <h6>Order Nº {{$order->number}}</h6>
                                                                <h6>Price : {{$key->price}}€ </h6>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col">
                                                                <h6>Report Description</h6>
                                                                <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Describe your problem" rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col text-right"><button class="btn btn-blue">Submit</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="modalSeeKey{{$key->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header row mx-0">
                                                        <div class="col-9 col-md-6">
                                                            <span class="flex-nowrap"> <i class="fas fa-key d-inline-block"></i><h5 class="d-inline-block">Key info </h5></span>
                                                        </div>
                                                        <div class="col-3 col-md-6 text-right">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" class="form-control userDetailsForm mt-2" id="exampleFormControlTextarea1" value="{{$key->key}}" readonly></input>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col text-right"><button class="btn btn-blue"><i class="fas fa-clipboard"></i> Copy to clipboard</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>