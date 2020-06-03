<div id="modalCategoryAdd" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Add Category</h6>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body text-left">
                <span>New Category</span>
                <form action={{url('/admin/category')}} method="POST">
                    @csrf
                    @method('put')
                    <input type="text" name="category" class="form-control mt-2" placeholder="Insert New Category">
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