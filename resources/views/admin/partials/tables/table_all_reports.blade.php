<div class="row justify-content-between flex-nowrap">
    <h2 class="col-6">{{ $title }}</h2>
</div>

<article class="col-sm-12 col-md-12 col-lg-12 mt-4">
    <div class="table-responsive table-striped">
        <table id="all-report-table" class="table p-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Title</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Description</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Reported</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Reporter</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Status</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Actions</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td class="align-middle text-center">
                        <h6>{{ $report->title }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $report->description }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $report->reported->username }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $report->reporter->username }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $report->status ? 'Closed' : 'Open' }}</h6>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group-justified btn-group-md">
                            <a href="{{ url('/admin/report/'.$report->id) }}" type="button mt-5 mb-5" class="btn btn-outline-dark btn-block flex-nowrap">
                                <span class="d-none d-md-inline-block">More Details</span><i class="ml-2 fas fa-arrow-circle-right"></i>
                            </a>
                            <form class="mt-1" action="{{ route('updateReport', [$report->id]) }}" method="post">
                                @csrf
                                <input hidden type="text" name="status" value="{{ $report->status ? 0 : 1 }}">
                                @if($report->status)
                                    <button type="submit" class="btn btn-green btn-block flex-nowrap">
                                        <span class="d-none d-md-inline-block">Open</span>
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-red btn-block flex-nowrap">
                                        <span class="d-none d-md-inline-block">Close</span>
                                    </button>
                                @endif
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