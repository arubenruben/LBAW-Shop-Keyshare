<?php function drawOffer(){ ?>
    <div id="content" class="container">
        <div class="row mt-5">
            <div class="col">
                <h3>Choose a Game</h3>
                <div class="row">
                    <div class="col-5 mt-3">
                        <img class="img-fluid productPageImgPreview" src="../../assets/images/games/GTAV/1.png" />
                    </div>
                    <div class="col-7 mt-2">
                        <form action="#" method="GET">
                            <div class="form-group">
                                <label for="inputGameName">
                                    <h5>Select Game</h5>
                                </label>
                                <select id="inputGameName" class="form-control form-control-lg">
                                    <option>GTA V</option>
                                    <option>FIFA 20</option>
                                    <option>Minecraft</option>
                                </select>
                            </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h3>Insert Keys</h3>
                        <div class="row mt-2 px-2 flex-nowrap">
                            <input type="text" class="form-control mt-auto mb-auto  d-inline-block" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                            <i class="fas fa-times-circle mt-auto mb-auto ml-2  d-inline-block"></i>
                        </div>
                        <div class="row mt-2 px-2 flex-nowrap">
                            <input type="text" class="form-control mt-auto mb-auto  d-inline-block" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                            <i class="fas fa-times-circle mt-auto mb-auto ml-2  d-inline-block"></i>
                        </div>
                        <div class="row mt-2 px-2 flex-nowrap">
                            <input type="text" class="form-control mt-auto mb-auto  d-inline-block" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                            <i class="fas fa-times-circle mt-auto mb-auto ml-2  d-inline-block"></i>
                        </div>
                        <div id="offerAddNewKeyContainer" class="row mt-4">
                            <i class="fas fa-plus-circle ml-auto mb-auto mt-auto"></i>
                            <span class="mt-auto mt-auto mb-auto mr-auto ml-3">Add New Key</span>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col">
                    <h3 class="d-none d-lg-block">Pricing</h3>
                    <div class="row">
                        <div class="col mt-auto mb-auto">
                            <div class="row">
                                <div class="form-inline mt-auto mb-auto ml-5 mr-auto">
                                    <label for="inputGamePrice">
                                        <h5 class="mr-4">Price</h5>
                                        <input type="text" class="form-control" id="inputGamePrice" placeholder="Price" value="10€">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <table class="table table-responsive mt-2 text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sale Nr</th>
                                            <th scope="col">Start Date</th>
                                            <th scope="col">End Date</th>
                                            <th scope="col">Percentage</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>2020/03/15</td>
                                            <td>2020/03/20</td>
                                            <td>40%</td>
                                            <td><i class="fas fa-times-circle"></i></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>2020/04/15</td>
                                            <td>2020/05/20</td>
                                            <td>30%</td>
                                            <td><i class="fas fa-times-circle"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div id="offerAddNewSaleContainer" class="row ml-auto mr-auto">
                                    <i class="fas fa-plus-circle mb-auto mt-auto"></i>
                                    <span class="mt-auto mt-auto mb-auto mr-auto ml-3">Add New Sale</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h3>Billing Details</h3>
                        <div class="form-group mt-4">
                            <label for="inputGameBillingEmail">
                                <h5>Billing Email</h5>
                            </label>
                            <div class="row">
                                <div class="col-8 mt-auto mb-auto">
                                    <input type="email" class="form-control mt-auto mb-auto ml-3" id="inputGameBillingEmail" placeholder="Billing Email" value="up2000@fe.up.pt">
                                </div>
                                <div class="col-4 mt-auto mb-auto">
                                    <img id="loginLogo" class="img-fluid" src="https://www.paypalobjects.com/webstatic/icon/pp258.png?01AD=3JXlaY30icDVvEQCh4JZU-i7mkkm-W9Z6vyRg8HQy96gcJahLG7n31Q&01RI=AC8F6687BF7C2EC&01NA=">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mt-5">
                    <label class="mt-auto mb-auto col-5 col-form-label">
                        <h5>Potential Gains:</h5>
                    </label>
                    <input type="text" readonly class="form-control-plaintext col-2 mr-auto mt-auto mb-auto" id="inputGameBillingGains" value="10€">
                    <button type="submit" class="btn btn-orange mb-2 ml-auto col-5 mt-auto mb-auto">Submit Offer</button>
                </div>
            </div>
        </div>
        </form>
    </div>
<?php } ?>