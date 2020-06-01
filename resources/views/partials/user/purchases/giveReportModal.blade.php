<article id="modalGiveReport" class="modal fade" role="dialog">
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
            <section class="modal-body">
                <div class="row">
                    <div id="reportBorderInfo" class="col-6 text-left">
                        <u><h5>Seller's Info</h5></u>
                        <a><h6 id="username-report"></h6></a>
                        <p>
                            <i class="fas fa-thumbs-up cl-success"></i>
                            <span id="approvalRate-report" class="font-weight-bold cl-success">%</span>
                            <i id="numSells-report" class="fas fa-shopping-cart"></i>
                        </p>
                    </div>
                    <div class="col-6 text-right">
                        <u>
                            <h5>Product in question</h5>
                            <h6 id="productName-report"></h6>
                        </u>
                        <h6 id="orderNumber-report">Order Nº </h6>
                        <h6 id="price-report">Price : € </h6>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <h5>Report Title</h5>
                        <input class="form-control" type="text" id="report-title" name="title" placeholder="Problem title">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <h6>Report Description</h6>
                        <textarea class="form-control userDetailsForm"
                                  id="report-description"
                                  placeholder="Describe your problem" value="" rows="3"></textarea>
                        <div class="report-response" hidden></div>
                    </div>
                </div>
            </section>
            <section class="modal-footer">
                <div id="submit-button-container-report" class="col text-right submit-report">
                    <button id="submitButton" class="btn btn-blue submit">Submit</button>
                </div>
            </section>
        </div>
    </div>
</article>