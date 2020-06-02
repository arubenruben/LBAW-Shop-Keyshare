<article id="modal-delete" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Delete Confirmation</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-left">
                <span>Are you sure you want to delete this?"</span>
            </div>
            <div class="modal-footer">
                <form class="col text-left" action={{url('/admin/product/'.$data)}} method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-blue"><i class="fas fa-check mr-2"></i> Confirm</button>
                </form>
                <div class="col text-right">
                    <button class="btn btn-blue" data-dismiss="modal"><i class="fas fa-times mr-2"></i> Cancel </button>
                </div>
            </div>
        </div>
    </div>
</article>