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
                        <div class="col">
                            <h3>Insert Keys</h3>
                            <div class="row mt-2 px-2 flex-nowrap">
                                <input type="text" class="form-control mt-auto mx-auto d-inline-block" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                                <button class="btn btn-danger ml-2"><i class="fas fa-times-circle mt-auto mb-auto d-inline-block"></i></button>
                            </div>
                            <div class="row mt-2 px-2 flex-nowrap">
                                <input type="text" class="form-control mt-auto mx-auto d-inline-block" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                                <button class="btn btn-danger ml-2"><i class="fas fa-times-circle my-auto d-inline-block"></i></button>
                            </div>
                            <div class="row mt-2 px-2 flex-nowrap">
                                <input type="text" class="form-control mt-auto mx-auto d-inline-block" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                                <button class="btn btn-danger ml-2"><i class="fas fa-times-circle mt-auto mb-auto d-inline-block"></i></button>
                            </div>
                            <div class="row mt-2 px-2 flex-nowrap">
                                <button class="btn btn-blue">
                                    <i class="fas fa-plus-circle ml-auto mb-auto mt-auto"></i>
                                    <span class="my-auto mr-auto ml-3">Add New Key</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h3 class="d-none d-lg-block">Sales</h3>
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
                            <div class="row mt-2 px-2 flex-nowrap">
                                <button class="btn btn-blue ml-2">
                                    <i class="fas fa-plus-circle"></i>
                                    <span class="my-auto mr-auto ml-3">Add New Sale</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <h3 class="d-none d-lg-block">Price: 20,00$</h3>
                        <div class="row">
                            <div class="col">
                                <div class="form-group mt-4">
                                    <label for="inputGameBillingEmail">
                                        <h5>Billing Email</h5>
                                    </label>
                                    <div class="row">
                                        <div class="col-8 mt-auto mb-auto">
                                            <input type="email" class="form-control mt-auto mb-auto ml-3" id="inputGameBillingEmail" placeholder="Billing Email" value="up2000@fe.up.pt">
                                        </div>
                                        <button id="paypalButton" class="btn btn-sm px-4 py-1 btn-outline-primary ml-2"><img src="../../assets/images/paypal/paypal.png" height="23"></button>
                                    </div>
                                    <div class="form-group row mt-5">
                                        <button type="submit" class="btn btn-orange mb-2 ml-auto col-5 mt-auto mb-auto">Submit Offer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>