<div id="content" class="container mt-5">
    <div class="row mt-5">
        <div class="col-sm-12 usercontent-left">
            @if($user->isBanned()) @include('partials.user.ban_appeal') @endif
            <div class="row px-3">
                <div class="col-sm-9 " style=" display:flex; align-items: center;">
                    <h4 class="text-left">My Reports<span class="badge ml-1 badge-secondary"> {{$myReports->count()}}</span></h4>
                </div>
            </div>
            <div class="container mt-3 mb-3">
                <div class="row ">
                    <div class="col-12">
                        <div class="table-responsive table-striped tableFixHead mt-3">
                            <table id="userOffersTable" class="table p-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="p-2 px-3 text-uppercase">Product Bought</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="p-2 px-3 text-uppercase">Buy date</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="py-2 text-uppercase">Report Date</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="py-2 text-uppercase">Options</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($myReports as $myReport)
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <a href = "{{route('product', ['productName' => $myReport->key->offer->product->name, 'platformName' => $myReport->key->offer->platform->name])}}">
                                                        <img src="{{asset('/pictures/games/'.$myReport->key->offer->product->picture->url)}}"
                                                            alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    </a>
                                                    <div class="ml-3 d-inline-block align-middle">
                                                        <div class="flex-nowrap">
                                                            <h5 class="mb-0 d-inline-block">
                                                                <a href="{{route('product', ['productName' => $myReport->key->offer->product->name, 'productPlatform' => $myReport->key->offer->platform->id])}}"
                                                                    class="text-dark d-inline-block">{{$myReport->key->offer->product->name}}</a>
                                                            </h5>
                                                            <span class="text-muted font-weight-normal font-italic d-inline-block">
                                                                [{{$myReport->key->offer->platform->name}}]</span>
                                                        </div>
                                                        <a href="{{route('profile', ['username' => $myReport->key->offer->seller->username])}}" class="text-muted font-weight-normal font-italic">{{$myReport->key->offer->seller->username}}</a>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="text-center align-middle">{{$myReport->key->order->date}}</td>
                                            <td class="text-center align-middle">{{$myReport->date}}</td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="{{route('showReport', ['id' => $myReport->id])}}"
                                                        class="btn btn-blue btn-block flex-nowrap" role="button">
                                                        <i class="fas fa-edit d-inline-block"></i>
                                                        <span class="d-none d-md-inline-block"> View Report </span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 usercontent-left mt-5">
            <div class="row px-3">
                <div class="col-sm-12">
                    <h4 class="text-left">Reports against me
                        <span class="badge ml-1 badge-secondary">{{$reportsAgainstMe->count()}}</span>
                    </h4>
                </div>
            </div>
            <div class="container mt-3 mb-3">
                <div class="row ">
                    <div class="col-12">
                        <div class="table-responsive table-striped tableFixHead mt-3 mt-3">
                            <table id="userOffersTable" class="table p-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="p-2 px-3 text-uppercase">Product Sold</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="py-2 text-uppercase">Report Date</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="py-2 text-uppercase">Reporter</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light text-center">
                                            <div class="py-2 text-uppercase">Options</div>
                                        </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reportsAgainstMe as $reportAgainstMe)
                                        <tr>
                                            <th scope="row" class="border-0 align-middle">
                                                <div class="p-2">
                                                    <img src="{{'/pictures/games/'.$reportAgainstMe->key->offer->product->picture->url}}"
                                                        alt="" width="150"
                                                        class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                                    <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                        <h5 class="mb-0 d-inline-block"><a
                                                                href="{{ url('/product/'.$reportAgainstMe->key->offer->product->id.'/'.$reportAgainstMe->key->offer->platform->id) }}"
                                                                class="text-dark">{{$reportAgainstMe->key->offer->product->name}}</a>
                                                        </h5><span
                                                            class="text-muted font-weight-normal font-italic d-inline-block">
                                                            [{{$reportAgainstMe->key->offer->platform->name}}]</span>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="text-center align-middle">{{$reportAgainstMe->date}}</td>
                                            <td class="text-center align-middle"><a
                                                    href="{{url('/user/'.$reportAgainstMe->reporter->username)}}"
                                                    class="text-muted font-weight-normal font-italic">{{$reportAgainstMe->reporter->username}}</a>
                                            </td>
                                            <td class="align-middle">
                                                <div class="btn-group-justified btn-group-md">
                                                    <a href="{{ url('/report/'.$reportAgainstMe->id) }}"
                                                        class="btn btn-blue btn-block flex-nowrap" role="button"> <i
                                                            class="fas fa-edit d-inline-block"></i> <span
                                                            class="d-none d-md-inline-block"> View Report </span></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>