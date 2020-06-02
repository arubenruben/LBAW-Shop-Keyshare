<div class="row justify-content-between flex-nowrap">
    <h2 class="col-6">{{ $title }}</h2>
</div>

<article class="col-sm-12 col-md-12 col-lg-12 mt-4">
    <div class="table-responsive table-striped">
        <table id="all-report-table" class="table p-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Number</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">User</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Date</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Price</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td class="align-middle text-center">
                        <h6>{{ $transaction->number }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $transaction->buyer->username }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $transaction->date }}</h6>
                    </td>
                    <td class="align-middle text-center">
                        <h6>{{ $transaction->keys->sum('price_sold') }} US$</h6>
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