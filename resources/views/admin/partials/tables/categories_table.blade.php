<table id="userOffersTable" class="table p-0">
    <thead>
        <tr>
            <th scope="col" class="border-0 bg-light text-center">
                <div class="p-2 px-3 text-uppercase">Categories</div>
            </th>
            <th scope="col" class="border-0 bg-light text-center">
                <div class="py-2 text-uppercase">Actions</div>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $category)
        @include('admin.partials.tables.category_table_entry',['data'=>$category])
        @endforeach
    </tbody>
</table>