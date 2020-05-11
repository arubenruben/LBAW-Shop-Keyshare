<div id="content" class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            @if($user->banned())
                <div class="row mb-2">
                    <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert"
                        data-toggle="modal" data-target="#modalAppeal">
                        You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
                    </div>
                </div>
            @endif
            <div class="row ">
                <div class="col-sm-12">
                    @php
                        $numberOfPurchases = 0;
                        foreach($orders as $order)
                            $numberOfPurchases += $order->keys->count();
                    @endphp
                    <h4 class="text-left">Purchase History <span
                            class="badge ml-1 badge-secondary">{{$numberOfPurchases}}</span></h4>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-responsive table-striped tableFixHead mt-3">
                        <table id="userOffersTable" class="table p-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product Details</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light text-center">
                                        <div class="py-2 text-uppercase">Date</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light text-center">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light text-center">
                                        <div class="py-2 text-uppercase">Options</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    @foreach($order->keys as $key)
                                        <tr>
                                            <td scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="{{$key->offer->product->picture->url}}" alt="" width="150"
                                                        class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <h5 class="mb-0 d-inline-block"><a
                                                                href="{{url("/product/".$key->offer->product->id."/".$key->offer->platform->id)}}"
                                                                class="text-dark">{{$key->offer->product->name}}</a></h5><span
                                                            class="text-muted font-weight-normal font-italic d-inline-block">
                                                            [{{$key->offer->platform->name}}]</span>
                                                        <a href="{{url("/user/".$key->offer->seller->username)}}"><span
                                                                class="text-muted font-weight-normal font-italic d-block">{{$key->offer->seller->username}}</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">{{$order->date}}</td>
                                            <td class="text-center align-middle"><strong>{{$key->price_sold}}€</strong></td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap"
                                                        data-toggle="modal" data-target="#modalSeeKey{{$key->id}}"><i
                                                            class="fas fa-key d-inline-block"></i> <span
                                                            class="d-none d-md-inline-block"> See key </span></button>
                                                    @if($user->feedback->where("key", "=", $key->id)->count() == 0)
                                                    <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap"
                                                        data-toggle="modal"
                                                        data-target="#modalGiveFeedback{{$key->id}} {{ $user->banned() ? 'disabled' : ''}}">
                                                        <i class="far fa-comment-alt d-inline-block"></i> <span
                                                            class="d-none d-md-inline-block">Leave feedback</span> </button>
                                                    @endif
                                                    @if($key->report == null)
                                                    <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap"
                                                        data-toggle="modal" data-target="#modalReport{{$key->id}}"
                                                        {{ $user->banned() ? 'disabled' : ''}}> <i
                                                            class="fas fa-user-slash d-inline-block"></i> <span
                                                            class="d-none d-md-inline-block"> Report Seller </span></button>
                                                    @else
                                                    <a href="{{ url('/report/'.$key->report->id) }}"
                                                        class="btn btn-blue btn-block flex-nowrap" role="button"> <i
                                                            class="fas fa-edit d-inline-block"></i> <span
                                                            class="d-none d-md-inline-block"> View Report </span></a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @include('partials.user.purchases.seeKeyModal')
                                        @include('partials.user.purchases.giveFeedbackModal')
                                        @include('partials.user.purchases.giveReportModal')
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>