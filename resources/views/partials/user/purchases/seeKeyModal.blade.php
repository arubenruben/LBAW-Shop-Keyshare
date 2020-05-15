<div id="modalSeeKey{{$key->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header row mx-0">
                <div class="col-9 col-md-6">
                    <span class="flex-nowrap"> <i class="fas fa-key d-inline-block"></i>
                        <h5 class="d-inline-block">Key info </h5>
                    </span>
                </div>
                <div class="col-3 col-md-6 text-right">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body key">
                <input type="text" class="form-control userDetailsForm mt-2" id="exampleFormControlTextarea1" value="{{$key->key}}" readonly/>
                <input type="hidden" class="key-name" value="{{$key->id}}">
            </div>
            <div class="modal-footer">
                <div class="col text-right"><button class="btn btn-blue"><i class="fas fa-clipboard"></i> Copy to clipboard</button>
                </div>
            </div>
        </div>
    </div>
</div>