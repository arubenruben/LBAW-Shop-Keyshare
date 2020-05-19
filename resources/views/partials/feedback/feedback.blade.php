<div class="modal fade bd-modal-lg" id="user-{{$seller->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header justify-content-around mt-2 row ml-0 mr-0">
                <div class="col-9 text-left">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4>{{$seller->username}}</h4>
                            <p><i class="fas fa-thumbs-up cl-success" ></i><span class="font-weight-bold cl-success">{{$seller->rating}}%</span> | <i class="fas fa-shopping-cart"></i> {{$seller->num_sells}} </p>
                        </div>
                        <div class="col-md-3 text-left">
                            <a href="{{route('profile', ['username' => $seller->username])}}" class="btn btn-sm btn-blue"><i class="fas fa-user-alt d-inline-block"></i> <span class="d-inline-block">View profile </span></a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <button class="close m-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <ul id="userNavbar" class="nav nav-tabs justify-content-center p-3 flex-nowrap">
                    @php $positive = 0; $negative = 0; @endphp
                    @foreach($seller->offers as $offer)
                        @foreach($offer->keys as $key)
                            @if($key->feedback !== null)
                                @if($key->feedback->evaluation)
                                    @php $positive++; @endphp
                                @else
                                    @php $negative++; @endphp
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                    <li class="nav-item"> <button class="btn all btn-blue-full active">All reviews<span class="badge badge-secondary d-none d-sm-inline-block ml-2">{{$positive + $negative}}</span></button> </li>
                    <li class="nav-item"> <button class="btn positive btn-green"><i class="fas fa-thumbs-up"></i>Positive<span class="badge badge-secondary d-none d-sm-inline-block ml-2">{{$positive}}</span></button></li>
                    <li class="nav-item"> <button class="btn negative btn-red"><i class="fas fa-thumbs-down"></i>Negative<span class="badge badge-secondary d-none d-sm-inline-block ml-2">{{$negative}}</span></button></li>
                </ul>
                <div class="col">
                    <div class="table-responsive tableFixHead mt-3">
                        <table class="table p-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light text-center"><div class="p-2 px-3 text-uppercase">Feedback</div></th>
                                    <th scope="col" class="border-0 bg-light text-center"><div class="py-2 text-uppercase">Date</div></th>
                                    <th scope="col" class="border-0 bg-light text-center"><div class="py-2 text-uppercase">Comment</div></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach($seller->offers as $offer)
                                    @foreach($offer->keys as $key)
                                            @if($key->feedback !== null)
                                                <tr class="feedback">
                                                    @if($key->feedback->evaluation)
                                                        <td class="eval text-center align-middle"><i class="fas fa-thumbs-up cl-success"></i></td>
                                                    @else
                                                        <td class="eval text-center align-middle"><i class="fas fa-thumbs-down cl-fail"></i></td>
                                                    @endif
                                                    <td class="text-center align-middle">{{$key->feedback->evaluation_date}}</td>
                                                    <td class="text-center align-middle"><strong>{{$key->feedback->comment}}</strong></td>
                                                </tr>
                                            @endif
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