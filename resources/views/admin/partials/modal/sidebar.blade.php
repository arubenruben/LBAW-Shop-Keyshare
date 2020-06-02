<div class="row mt-4 d-block d-lg-none">
    <div class="col-sm-12 text-center">
        <button data-toggle="modal" data-target="#adminModal" class="btn btn-blue btn-md mt-2 ">Admin Options</button>
    </div>
</div>
<div id="sideBarFilterResponsive">
    <div class="modal left fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" style="padding: 0">
                    <div id="sidebar" class="col" style="padding: 0">
                        @include('admin.partials.sidebar.sidebar')
                    </div>
                </div>
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>