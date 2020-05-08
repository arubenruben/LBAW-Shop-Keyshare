<form id="content" class="container">
    @csrf
    <div class="row mt-5">
        <div class="col">
            <h3>Choose a Game</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-5 mt-3 my-auto d-none d-md-block">
            <img class="img-fluid productPageImgPreview" src="{{asset('pictures/games/default.png')}}" />
        </div>
        <div class="col-12 col-md-7 mt-2">

            <section class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="game">
                            <h4>Select Game</h4>
                        </label>
                        <select id="game-selection" name="game" class="form-control form-control-md" required>
                            <option disabled selected value class="d-none"></option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-img="{{ asset('/images/games/'.$product->image) }}" data-platforms="{{ json_encode(array_values($product->platforms->toArray())) }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <label for="platform" class="mt-3">
                            <h4>Select Platform</h4>
                        </label>
                        <select id="platform-selection" name="platform" class="form-control form-control-md" required>

                        </select>
                    </div>
                </div>
            </section>

            <section id="key-input" class="row mt-2">
                <div class="col-12 flex-nowrap">

                    <div class="form-group">
                        <h4>Keys</h4>
                        <div id="key-input-added">

                        </div>

                        <div class="input-group mt-2">
                            <input type="text" id="key-input-add" class="form-control mr-2" placeholder="New key" value="">
                        </div>
                        <span id="key-input-error" class="error"></span>


                        <div class="row mt-3 flex-nowrap">
                            <div class="col-12 text-center">
                                <button type="button" class="btn btn-blue text-center">
                                    <i class="fas fa-plus-circle ml-auto mb-auto mt-auto d-inline-block"></i>
                                    <span class="d-inline-block my-auto mr-auto ml-3">Add Key</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col mt-5" id="discount-input">
            <h3>Discounts</h3>
            <table class="table table-responsive mt-2 text-center">
                <thead>
                    <tr>
                        <th scope="col">Number</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Percentage</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr id = "discount-input-add">
                        <th scope="row">1</th>
                        <td><input type="date" class="mx-auto form-control" value="{{ Carbon\Carbon::now()->toString() }}"></td>
                        <td><input type="date" class="mx-auto form-control" value="{{ Carbon\Carbon::tomorrow()->toString() }}"></td>
                        <td class="w-25"><input type="number" class="mx-auto form-control" min="1" max="99" value="1"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <span id="discount-input-error" class="error"></span>

            <div class="row mt-1">
                <div class="col text-center">
                    <button type="button" class="btn btn-blue ml-2">
                        <i class="fas fa-plus-circle"></i>
                        <span class="my-auto mr-auto ml-3">Add Discount</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col mt-5" id="price-input">
            <h3>Billing</h3>
            <div class="input-group mt-5">
                <label for="exampleInputEmail1">
                    <h5 class="pt-1">Price</h5>
                </label>
                <input type="number" name="price" class="form-control ml-2"/>
            </div>

            <div class="form-group mt-4">
                <label for="paypal">
                    <h5>Billing Email</h5>
                </label>
                <div class="input-group">
                    <input type="email" name="paypal" class="form-control mt-auto mb-auto" placeholder="Billing Email" value="" disabled>
                    <span class="input-group-btn">
                            <button type="button" id="paypalButton" class="btn d-none d-lg-block btn-sm px-4 py-1 btn-outline-primary ml-2"><img src="{{ asset('/pictures/paypal/paypal.png') }}" height="26"></button>
                            <button type="button" id="paypalButton" class="btn d-block d-lg-none btn-sm px-4 py-1 btn-outline-primary ml-2"><img src="{{ asset('/pictures/paypal/paypalLogo.png') }}" height="26"></button>
                        </span>
                </div>


            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12 text-right">
            <div class="form-group">
                <button type="button" class="btn btn-orange px-5 py-2">Submit Offer</button>
            </div>

        </div>
    </div>
</form>
