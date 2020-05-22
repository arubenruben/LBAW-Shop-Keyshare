<div id="modalReport{{$key->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header row mx-0">
                <div class="col-9 col-md-6">
                    <span class="flex-nowrap"> <i class="fas fa-user-slash d-inline-block"></i>
                        <h5 class="d-inline-block">Report Seller </h5>
                    </span>
                </div>
                <div class="col-9 col-md-6 text-right">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div id="reportBorderInfo" class="col-6 text-left">
                        <u><h5>Seller's Info</h5></u>
                        <h6>{{$key->offer->seller->username}}</h6>
                        <p><i class="fas fa-thumbs-up cl-success"></i>
                            <span class="font-weight-bold cl-success">{{$key->offer->seller->rating}}%</span>
                            | <i class="fas fa-shopping-cart"></i>
                            {{$key->offer->seller->num_sells}} </p>
                    </div>
                    <div class="col-6 text-right">
                        <u><h5>Product in question</h5></u>
                        <h6>Order Nº {{$order->number}}</h6>
                        <h6>Price : {{$key->price_sold}}€ </h6>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <h6>Report Description</h6>
                        <textarea class="form-control userDetailsForm"
                                  id="exampleFormControlTextarea1"
                                  placeholder="Describe your problem" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col text-right"><button class="btn btn-blue">Submit</button></div>
            </div>
        </div>
    </div>
</div>