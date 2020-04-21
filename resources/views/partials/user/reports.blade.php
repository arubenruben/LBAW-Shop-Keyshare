<div id="content" class="container mt-5">
    <div class="row mt-5">
        <div class="col-sm-12 usercontent-left">
            @if($user->banned())
            <div class="row mb-2">
                <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
                    You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
                </div>
            </div>
            @endif
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
                                            <img src="{{'/images/games/original/'.$myReport->key()->getResults()->offer()->getResults()->product()->getResults()->image()->getResults()->url}}" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <div class="flex-nowrap">
                                                    <h5 class="mb-0 d-inline-block"><a href="{{ url('/product/'.$myReport->key()->getResults()->offer()->getResults()->product()->getResults()->id.'/'.$myReport->key()->getResults()->offer()->getResults()->platform()->getResults()->platform_id) }}" class="text-dark d-inline-block">{{$myReport->key()->getResults()->offer()->getResults()->product()->getResults()->name}}</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [{{$myReport->key()->getResults()->offer()->getResults()->platform()->getResults()->name}}]</span>
                                                </div><a href="/user/{{$myReport->key()->getResults()->offer()->getResults()->seller()->getResults()->username}}" class="text-muted font-weight-normal font-italic">{{$myReport->key()->getResults()->offer()->getResults()->seller()->getResults()->username}}</a>
                                            </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                        </div>
                                    </th>
                                    <td class="text-center align-middle">{{$myReport->key()->getResults()->orders()->getResults()->date}}</td>
                                    <td class="text-center align-middle">{{$myReport->date}}</td>
                                    <td class="align-middle">
                                        <div class="btn-group-justified btn-group-md">
                                            <a href="{{'/report/'.$myReport->id}}" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
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
                    <h4 class="text-left">Reports against me<span class="badge ml-1 badge-secondary"> {{$reportsAgainstMe->count()}}</span></h4>
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
                                            <img src="{{'/images/games/original/'.$reportAgainstMe->key()->getResults()->offer()->getResults()->product()->getResults()->image()->getResults()->url}}" alt="" width="150" class="img-fluid rounded shadow-sm d-none d-sm-inline userOffersTableEntryImage">
                                            <div class="ml-3 d-inline-block align-middle flex-nowrap">
                                                <h5 class="mb-0 d-inline-block"><a href="{{ url('/product/'.$reportAgainstMe->key()->getResults()->offer()->getResults()->product()->getResults()->id.'/'.$reportAgainstMe->key()->getResults()->offer()->getResults()->platform()->getResults()->platform_id) }}" class="text-dark">{{$reportAgainstMe->key()->getResults()->offer()->getResults()->product()->getResults()->name}}</a></h5><span class="text-muted font-weight-normal font-italic d-inline-block"> [{{$reportAgainstMe->key()->getResults()->offer()->getResults()->platform()->getResults()->name}}]</span>
                                            </div> <!-- <a data-toggle="modal" data-target="#" ><span class="text-muted font-weight-normal font-italic d-block">nightwalker123</span> </a> -->
                                        </div>
                                    </th>
                                    <td class="text-center align-middle">{{$reportAgainstMe->date}}</td>
                                    <td class="text-center align-middle"><a href="{{url('/user/'.$reportAgainstMe->reportee()->getResults()->username)}}" class="text-muted font-weight-normal font-italic">{{$reportAgainstMe->reportee()->getResults()->username}}</a></td>
                                    <td class="align-middle">
                                        <div class="btn-group-justified btn-group-md">
                                            <a href="{{ url('/report/'.$reportAgainstMe->id) }}" class="btn btn-blue btn-block flex-nowrap" role="button"> <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> View Report </span></a>
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
