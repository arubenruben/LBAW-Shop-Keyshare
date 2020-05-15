<section id="content" class="container">
    <div class="row mt-5">
        <div class="col">
            <h3>Choose a Game</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-5 mt-3 my-auto d-none d-md-block">
            <img class="img-fluid productPageImgPreview" src="{{asset('pictures/games/'.$offer->product->picture->url)}}"/>
        </div>
        <div class="col-12 col-md-7 mt-2">
            <h4>Game</h4>
            <p class="pl-2 h5 form-control form-control-md" readonly>{{ $offer->product->name }}</p>
            <h5>Platform</h5>
            <p class="pl-2 h5 form-control form-control-md" readonly>{{ $offer->platform->name }}</p>
            <section class="row mt-2" id="offer-keys">
                <div class="col-12 flex-nowrap">
                    <div class="form-group">
                        <h4>Keys</h4>
                        <div id="offer-keys-added">
                        @foreach($offer->keys as $key)
                            <article class="input-group mt-2">
                                <p class="form-control mr-2" readonly>{{ $key->key }}</p>
                                <span class="input-group-btn mt-2">
                                @if($key->order !== null)
                                    <button type="button" class="btn btn-green noHover">Sold</button>
                                @else
                                    <button type="button" class="btn btn-red" data-key-id="{{ $key->id }}"><i class="fas fa-times-circle"></i></button>
                                @endif
                                </span>
                            </article>
                        @endforeach
                        </div>
                        <div class="input-group mt-2">
                            <input type="text" id="offer-keys-add" class="form-control mr-2" placeholder="New key" value="">
                        </div>
                        <span id="offer-keys-error" class="error"></span>
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
        <section class="col mt-5" id="offer-discounts">
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
                @for($i = 0; $i < $offer->discounts->count(); $i++)
                    <tr>
                        <th scope="row">{{ $i + 1 }}</th>
                        <td><span class="mx-auto form-control nobr" readonly>{{ $offer->discounts[$i]->start_date }}</span></td>
                        <td><span class="mx-auto form-control nobr" readonly>{{ $offer->discounts[$i]->end_date }}</span></td>
                        <td class="w-25"><span class="mx-auto form-control" readonly>{{ $offer->discounts[$i]->rate }}</span></td>
                        <td><button class="btn btn-red ml-2" data-discount-id="{{ $offer->discounts[$i]->id }}"><i class="fas fa-times-circle mt-auto mb-auto d-inline-block"></i></button></td>
                    </tr>
                @endfor
                    <tr id="offer-discounts-add">
                        <th scope="row"></th>
                        <td><input type="date" class="mx-auto form-control text-center" value="{{ date('Y-m-d') }}"></td>
                        <td><input type="date" class="mx-auto form-control text-center" value="{{ date('Y-m-d', time() + (24 * 60 * 60)) }}"></td>
                        <td class="w-25"><input type="number" class="mx-auto form-control text-center" min="1" max="99" value="1"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <span id="offer-discounts-error" class="error"></span>

            <div class="row mt-1">
                <div class="col text-center">
                    <button type="button" class="btn btn-blue ml-2">
                        <i class="fas fa-plus-circle"></i>
                        <span class="my-auto mr-auto ml-3">Add Discount</span>
                    </button>
                </div>
            </div>
        </section>
        <div class="col mt-5">
            <h3>Billing</h3>
            <div class="form-group mt-5">
                <h4 class="pt-1">Price Per Key</h4>
                <p class="form-control" readonly>{{ $offer->price }}</p>
            </div>

            <div class="form-group mt-4">
                <label for="paypal" class="h4">
                    Billing Email
                </label>
                <div class="input-group">
                    <input type="email" id="paypal" name="paypal" class="form-control mt-auto mb-auto" placeholder="Billing Email" value="" readonly>
                    <span class="input-group-btn">
                            <button type="button" id="paypalButton" class="btn d-none d-lg-block btn-sm px-4 py-1 btn-outline-primary ml-2"><img src="{{ asset('/pictures/paypal/paypal.png') }}" height="26"></button>
                            <button type="button" id="paypalButton" class="btn d-block d-lg-none btn-sm px-4 py-1 btn-outline-primary ml-2"><img src="{{ asset('/pictures/paypal/paypalLogo.png') }}" height="26"></button>
                        </span>
                </div>
            </div>
        </div>
    </div>

    <form class="row mt-5" action="{{ url()->current() }}" method="get">
        @method('DELETE')
        <div class="col-12 text-right">
            <div class="form-group">
                <input type="submit" class="btn btn-red px-5 py-2" value="Cancel Offer">
            </div>
        </div>
    </form>
</section>