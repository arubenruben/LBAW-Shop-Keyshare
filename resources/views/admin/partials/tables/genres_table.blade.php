<article class="col mt-4">
    <div class="table-responsive table-striped tableFixHead">
        <table id="userOffersTable" class="table p-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Genres</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Actions</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $genre)
                @include('admin.partials.tables.genre_table_entry',['data'=>$genre])
                @endforeach
            </tbody>
        </table>
    </div>
</article>