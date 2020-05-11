<div id="modalGiveFeedback{{$key->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header row mx-0">
                <div class="col-9 col-md-6">
                    <span class="flex-nowrap"> <i class="far fa-comment-alt d-inline-block"></i>
                        <h5 class="d-inline-block">Leave feedback </h5>
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
                        <p>
                            <i class="fas fa-thumbs-up cl-success"></i>
                            <span class="font-weight-bold cl-success">{{$key->offer->seller->rating}}%</span>
                            <i class="fas fa-shopping-cart"></i>
                            {{$key->offer->seller->num_sells}}
                        </p>
                    </div>
                    <div class="col-6 text-right">
                        <u><h5>Product in question</h5></u>
                        <h6>Order Nº {{$order->number}}</h6>
                        <h6>Price : {{$key->price_sold}}€ </h6>
                    </div>
                </div>
                <hr>
                <div class="row mt-1">
                    <div class="col-6 text-center">
                        <button class="btn positive-feedback btn-green btn-lg px-5">
                            <i class="fas positive-feedback-i fa-thumbs-up cl-success"></i>
                        </button>
                    </div>
                    <div class="col-6 text-center">
                        <button class="btn negative-feedback btn-red btn-lg px-5">
                            <i class="fas negative-feedback-i fa-thumbs-down cl-fail"></i>
                        </button>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <h6>Comment</h6>
                        <textarea class="form-control userDetailsForm mt-2"
                                  id="description"
                                  placeholder="Describe your experience with this seller"
                                  rows="3" value=""></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col text-right submit-feedback"><button class="btn btn-blue submit"> Submit</button></div>
            </div>
        </div>
    </div>
</div>
