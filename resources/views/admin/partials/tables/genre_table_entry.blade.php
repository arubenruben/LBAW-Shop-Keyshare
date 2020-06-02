<tr>
    <td class="align-middle text-center">
        <h6>{{$data->name}}</h6>
    </td>
    <td class="align-middle">
        <div class="btn-group-justified btn-group-md">
            <button type="button mt-5 mb-5 " class="btn btn-blue btn-block flex-nowrap" data-toggle="modal"
                data-target={{"#modalGenreEdit".$data->id}}>
                <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block">Edit
                    Genre</span>
            </button>
            <button type="button mt-5 mb-5 " class="btn btn-red btn-block flex-nowrap" data-toggle="modal"
                data-target={{"#modalGenreConfirm".$data->id}}>
                <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block">Delete
                    Genre</span>
            </button>
        </div>
    </td>
    @include('admin.partials.modal.genre.genreDelete',['data'=>$data])
    @include('admin.partials.modal.genre.genreEdit',['data'=>$data])
</tr>