<div id={{"modalPlatformConfirm".$data->id}} class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Are you sure you want to delete?</h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body text-left">
                <span>By deleting this Platform You wont be able to recovery it</span>
            </div>
            <div class="modal-footer">
                <div class="col text-left">
                    <form action={{url('/admin/platform/'.$data->id)}} method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-blue"><i class="fas fa-check mr-2"></i>Confirm </button>
                    </form>
                </div>
                <div class="col text-right"><button class="btn btn-blue" data-dismiss="modal"><i
                            class="fas fa-times mr-2"></i> Cancel </button></div>
            </div>
        </div>
    </div>
</div>