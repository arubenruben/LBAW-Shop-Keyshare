<!-- Feedback Modal -->
<div class="modal fade bd-modal-lg" id="userFeedback{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-around mt-2 row">
                <div class="col-9 text-left">
                    <div class="row">
                        <div class="col-md-6 text-left">
                            <h4>{{ $user->username }}</h4>
                            <p><i class="fas fa-thumbs-up cl-success" ></i><span class="font-weight-bold cl-success">{{ $user->rating }}%</span> | <i class="fas fa-shopping-cart"></i>{{ $user->num_sells }}</p>
                        </div>
                        <div class="col-md-3 text-left">
                            <a href="{{ url('/user/'.$user->username) }}" class="btn btn-sm btn-blue"><i class="fas fa-user-alt d-inline-block"></i> <span class="d-inline-block">View profile</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <button class="close m-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <!-- modal body -->            
            <div class="modal-body">
                <!-- feedback header -->              
                <ul id="userNavbar" class="nav nav-tabs justify-content-center p-3 flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link deco-none ml-2 mr-2 userNavbarItem" href="#all"><button class="btn btn-blue-full active">All reviews<span class="badge badge-secondary d-none d-sm-inline-block ml-2">14</span></button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link deco-none ml-2 mr-2 userNavbarItem" href="#positive"><button class="btn btn-green"><i class="fas fa-thumbs-up"></i>Positive<span class="badge badge-secondary d-none d-sm-inline-block ml-2">13</span></button></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link deco-none ml-2 mr-2 userNavbarItem" href="#negative"><button class="btn btn-red"><i class="fas fa-thumbs-down"></i>Negative<span class="badge badge-secondary d-none d-sm-inline-block ml-2">1</span></button></a>
                    </li>
                </ul>
                <hr class="mt-0">
                <div class="col">
                    <div class="table-responsive tableFixHead mt-3">
                        <table class="table p-0">
                            <thead>
                            <tr>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="p-2 px-3 text-uppercase">Feedback</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-2 text-uppercase">Date</div>
                                </th>
                                <th scope="col" class="border-0 bg-light text-center">
                                    <div class="py-2 text-uppercase">Comment</div>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr>
                                <td class="text-center align-middle"><i class="fas fa-thumbs-up cl-success"></i></td>
                                <td class="text-center align-middle">2020/07/10</td>
                                <td class="text-center align-middle"><strong>Great product</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>