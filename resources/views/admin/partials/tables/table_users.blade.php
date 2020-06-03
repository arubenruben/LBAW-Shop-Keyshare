<div class="row justify-content-between flex-nowrap">
    <h2 class="col-6">{{ $title }}</h2>
    <form action="{{ url('/admin/user') }}" method="get" class="col-5 d-inline-flex">
        <input class="form-control" name="query" type="text" placeholder="Search" aria-label="Search" value="{{ $query }}">
        <button type="submit" class="form-control ml-1 btn btn-outline-dark w-25"><i class="fas fa-search"></i></button>
        <a href="{{ url('/admin/user') }}" type="reset" class="form-control ml-1 btn btn-outline-dark w-25"><i class="fas fa-times"></i></a>
    </form>
</div>

<article class="col-sm-12 col-md-12 col-lg-12 mt-4">
    <div class="table-responsive table-striped">
        <table id="all-user-table" class="table p-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Photo</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Username</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Email</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Description</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Actions</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="align-middle text-center">
                        <img src="{{ asset('/pictures/profile/'.$user->picture->url) }}" class="img-fluid adminUserTableImage" alt="Profile photo of {{ $user->username }}">
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $user->username }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $user->email }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $user->description }}</h6>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group-justified btn-group-md">
                            @if($user->isBanned())
                                <button type="button" class="btn btn-green btn-block flex-nowrap" data-toggle="modal" data-target="#banModal" data-user="{{ $user->id }}" data-banned="true">
                                    <span class="d-inline-block">Unban</span>
                                </button>
                            @else
                                <button type="button" class="btn btn-red btn-block flex-nowrap" data-toggle="modal" data-target="#banModal" data-user="{{ $user->id }}" data-banned="false">
                                    <span class="d-inline-block">Ban</span>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mt-5">
        <div class="ml-auto">
            {{$links}}
        </div>
    </div>

</article>

<div id="banModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-left">
                <span id="banModal-message">Are you sure you want to ban/unban this user?</span>
            </div>
            <div class="modal-footer">
                <form method="post" class="col text-left" data-default="{{ url('/admin/user').'/' }}" id="banModal-confirm">
                    @csrf
                    <input hidden name="ban" type="text">
                    <button type="submit" class="btn btn-blue"><i class="fas fa-check mr-2"></i> Confirm </button>
                </form>
                <div class="col text-right">
                    <button type="button" class="btn btn-blue" data-dismiss="modal"><i class="fas fa-times mr-2"></i> Cancel </button>
                </div>
            </div>
        </div>
    </div>
</div>