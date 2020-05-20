<article id="modalGiveFeedback" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <header class="modal-header row mx-0">
                <div class="col-9 col-md-6">
                    <span class="flex-nowrap"> <i class="far fa-comment-alt d-inline-block"></i>
                        <h5 class="d-inline-block">Leave feedback </h5>
                    </span>
                </div>
                <div class="col-9 col-md-6 text-right">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </header>
            <section class="modal-body">
                <div class="row">
                    <div id="reportBorderInfo" class="col-6 text-left">
                        <u>
                            <h5>Seller's Info</h5>
                        </u>
                        <h6 id="username"></h6>
                        <p>
                            <i class="fas fa-thumbs-up cl-success"></i>
                            <span id="approvalRate" class="font-weight-bold cl-success">%</span>
                            <i class="fas fa-shopping-cart"></i>

                        </p>
                    </div>
                    <div class="col-6 text-right">
                        <u>
                            <h5>Product in question</h5>
                            <h6 id="productName"></h6>
                        </u>
                        <h6 id="orderNumber">Order Nº </h6>
                        <h6 id="price">Price : € </h6>
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
                        <textarea id="comment" class="form-control userDetailsForm mt-2" id="description"
                            placeholder="Describe your experience with this seller" rows="3" value=""></textarea>
                        <div class="feedback-response" hidden></div>
                    </div>
                </div>
            </section>
            <section class="modal-footer">
                <div class="col text-right submit-feedback">
                    <button class="btn btn-blue submit">Submit</button>
                </div>
            </section>
        </div>
    </div>
</article>