<div id="modalGenreAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add Genre</h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body text-left">
                <span>New Genre</span>
                <form action={{url('/admin/genre')}} method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="genre" class="form-control mt-2" placeholder="Insert New Genre">
            </div>
            <div class="modal-footer">
                <div class="col text-left"><button type="submit" class="btn btn-blue"><i
                            class="fas fa-check mr-2"></i>Confirm</button></div>
                <div class="col text-right"><button class="btn btn-blue" data-dismiss="modal"><i
                            class="fas fa-times mr-2"></i> Cancel</button></div>
                </form>
            </div>
        </div>
    </div>
</div>