<div class="row justify-content-between flex-nowrap">
    <h2 class="col-6">{{ $title }}</h2>
</div>

<article class="col-sm-12 col-md-12 col-lg-12 mt-4">
    <div class="table-responsive table-striped">
        <table id="all-feedback-table" class="table p-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">User</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Appeal</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Date</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Actions</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($appeals as $appeal)
                <tr>
                    <td class="align-middle text-center">
                        <h6>{{ $appeal->user->username }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $appeal->ban_appeal }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $appeal->date }}</h6>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group-justified btn-group-md">
                            <form action="{{ route('userAdminUpdate', [$appeal->user->id]) }}" method="post">
                                @csrf
                                <input hidden name="ban" value="0">
                                <button type="submit" class="btn btn-green btn-block flex-nowrap">
                                    <span class="d-inline-block">Unban</span>
                                </button>
                            </form>
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