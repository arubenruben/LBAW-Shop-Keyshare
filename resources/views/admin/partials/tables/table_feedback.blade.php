<div class="row justify-content-between flex-nowrap">
    <h2 class="col-6">{{ $title }}</h2>
</div>

<article class="col-sm-12 col-md-12 col-lg-12 mt-4">
    <div class="table-responsive table-striped">
        <table id="all-report-table" class="table p-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Buyer</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Evaluation</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Comment</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Date</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Seller</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Actions</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedback as $feedback_entry)
                <tr>
                    <td class="align-middle text-center">
                        <h6>{{ $feedback_entry->buyer->username }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <i class="fas fa-thumbs-{{ $feedback_entry->evaluation ? 'up cl-success' : 'down cl-fail' }}"></i>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $feedback_entry->comment }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $feedback_entry->evaluation_date }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $feedback_entry->seller->username }}</h6>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group-justified btn-group-md">
                            <form action="{{ route('deleteFeedback', [$feedback_entry->id]) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-red btn-block flex-nowrap">
                                    <span class="d-md-inline-block">Delete</span>
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