<?php function drawFeedbackPopup($id) { ?>
    <!-- Modal -->
    <div class="modal fade bd-modal-lg<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header justify-content-around">
                    <div class="col">
                        <h4>bestseller439</h4>
                        <p><i class="fas fa-thumbs-up cl-success mr-1"></i><span class="font-weight-bold cl-success">99%</span> | <i class="fas fa-shopping-cart"></i> 1897 </p>
                    </div>
                    <div class="col m-auto">
                        <a href="otherUser.php" class="btn btn-blue"><i class="fas fa-user-alt"></i> View profile</a>
                    </div>
                    <button type="button" class="close m-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- modal body -->
                <div class="modal-body">
                    <!-- feedback header -->
                    <div class="row font-weight-bold">
                        <div class="col mb-2">
                            <span class="active-border pb-1"> All reviews <span class="badge badge-secondary">2</span></span>
                        </div>
                        <div class="col mb-2">
                            <span class="inactive-border pb-1"><i class="fas fa-thumbs-up cl-success"></i> Positive <span class="badge badge-secondary">1</span></span>
                        </div>
                        <div class="col mb-1">
                            <span class="inactive-border pb-1"><i class="fas fa-thumbs-down cl-fail"></i> Negative <span class="badge badge-secondary">1</span></span>
                        </div>
                    </div>
                    <hr class="mt-0">
                    <div class="container-fluid">
                        <!-- feedback ratings -->
                        <div class="row">
                            <div class="col"> <i class="fas fa-thumbs-down cl-fail"></i> </div>
                            <div class="col"> Mar 06, 2020 </div>
                            <div class="col"> key doesnt work </div>
                        </div>
                        <hr class="m-2">
                        <div class="row">
                            <div class="col">
                                <i class="fas fa-thumbs-up cl-success"></i>
                            </div>
                            <div class="col">
                                Mar 06, 2020
                            </div>
                            <div class="col">
                                key works
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-blue">Load More</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>