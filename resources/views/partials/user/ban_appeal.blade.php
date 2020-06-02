<article class="row mb-2">
    <div class="col-7 color:red text-center mx-auto alert alert-danger" role="alert">
        You are currently banned! Some functionalities are disabled.
        @if(Auth::user()->banAppeal == null)
            <a class="font-weight-bold" href="#appealModal" data-toggle="modal" data-target="#appealModal">Click to appeal</a>
        @else
            <p class="mb-0">Your ban appeal: '{{ Auth::user()->banAppeal->ban_appeal }}'</p>
        @endif
    </div>

    <div id="appealModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <section class="modal-header row mx-0">
                    <div class="col-9 col-md-6">
                        <h5 class="d-inline-block align-left">Appeal your Ban</h5>
                    </div>
                    <div class="col-9 col-md-6 text-right">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                </section>
                <section class="modal-body">
                    <article class="row mt-1">
                        <div class="col">
                            <h5>An admin will access your situation after you submit an appeal, please be as self explanatory as
                                possible in the comment section</h5>
                        </div>
                    </article>
                    <article class="row mt-3">
                        <div class="col">
                            <h6>Appeal Comment</h6>
                            <textarea class="form-control userDetailsForm" name="appeal" placeholder="Please give your reasons for the appeal" rows="3"></textarea>
                        </div>
                    </article>
                </section>
                <section class="modal-footer">
                    <article class="col text-left"><span id="appealModal-message" class=""></span></article>
                    <article class="col text-right"><button type="button" id="appealModal-submit" class="btn btn-blue">Submit</button></article>
                </section>
            </div>
        </div>
    </div>
</article>