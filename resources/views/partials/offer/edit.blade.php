<div id="content" class="container">
    <div class="row mt-5">
        <div class="col">
            <h3>Choose a Game</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-5 mt-3 my-auto d-none d-md-block">
            <img class="img-fluid productPageImgPreview" src="../../assets/pictures/games/GTAV/1.png" />
        </div>
        <div class="col-12 col-md-7 mt-2">

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="inputGameName">
                            <h4>Select Game</h4>
                        </label>
                        <select id="inputGameName" class="form-control form-control-md">
                            <option>GTA V</option>
                            <option>FIFA 20</option>
                            <option>Minecraft</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12 flex-nowrap">

                    <div class="form-group">
                        <h4>Keys</h4>
                        <div class="input-group">
                            <input type="text" class="form-control mr-2" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                            <span class="input-group-btn">
                                    <button class="btn btn-red"><i class="fas fa-times-circle"></i></button>
                                </span>
                        </div>

                        <div class="input-group mt-2">
                            <input type="text" class="form-control mr-2" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                            <span class="input-group-btn">
                                    <button class="btn btn-red"><i class="fas fa-times-circle"></i></button>
                                </span>
                        </div>

                        <div class="input-group mt-2">
                            <input type="text" class="form-control mr-2" id="exampleFormControlInput1" placeholder="Key" value="55-FF-55">
                            <span class="input-group-btn">
                                    <button class="btn btn-red"><i class="fas fa-times-circle"></i></button>
                                </span>
                        </div>

                        <div class="row mt-3 flex-nowrap">
                            <div class="col-12 text-center">
                                <button class="btn btn-blue text-center">
                                    <i class="fas fa-plus-circle ml-auto mb-auto mt-auto d-inline-block"></i>
                                    <span class="d-inline-block my-auto mr-auto ml-3">Add New Key</span>
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-6 mt-5">
            <h3>Sales</h3>
            <div class="row">
                <div class="col-12">
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
                            <td><button class="btn btn-red ml-2"><i class="fas fa-times-circle mt-auto mb-auto d-inline-block"></i></button></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>2020/04/15</td>
                            <td>2020/05/20</td>
                            <td>30%</td>
                            <td><button class="btn btn-red ml-2"><i class="fas fa-times-circle mt-auto mb-auto d-inline-block"></i></button></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mt-1">
                <div class="col text-center">
                    <button class="btn btn-blue ml-2">
                        <i class="fas fa-plus-circle"></i>
                        <span class="my-auto mr-auto ml-3">Add New Sale</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-5">
            <h3>Billing</h3>
            <div class="input-group mt-5">
                <label for="exampleInputEmail1">
                    <h5 class="pt-1">Price</h5>
                </label>

                <input type="text" class="form-control ml-2" id="exampleInputEmail1" />
            </div>



            <div class="form-group mt-4">
                <label for="inputGameBillingEmail">
                    <h5>Billing Email</h5>
                </label>

                <div class="input-group">
                    <input type="email" class="form-control mt-auto mb-auto" placeholder="Billing Email" value="up2000@fe.up.pt" disabled>
                    <span class="input-group-btn">
                            <button id="paypalButton" class="btn d-none d-lg-block btn-sm px-4 py-1 btn-outline-primary ml-2"><img src="../../assets/pictures/paypal/paypal.png" height="26"></button>
                            <button id="paypalButton" class="btn d-block d-lg-none btn-sm px-4 py-1 btn-outline-primary ml-2"><img src="../../assets/pictures/paypal/paypalLogo.png" height="26"></button>
                        </span>
                </div>


            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-right">
            <div class="form-group">
                <button type="submit" class="btn btn-orange px-5 py-2">Submit Offer</button>
            </div>

        </div>
    </div>
