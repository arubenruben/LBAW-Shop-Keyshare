<div class="row justify-content-between flex-nowrap">
    <h2 class="col-4">{{ $title }}</h2>
    <section class="col-5 cl-fail">
        @foreach ($errors->all() as $message)
            <p class="m-0">{{ $message }}</p>
        @endforeach
    </section>
    <button type="button" class="btn btn-red btn-block flex-nowrap mr-2" data-toggle="modal" data-target="#faqAddModal">
        <span class="d-none d-md-inline-block">Add new FAQ</span> <i class="fas fa-plus"></i>
    </button>
</div>

<article class="col-12 mt-4">
    <div class="table-responsive table-striped">
        <table id="all-faq-table" class="table p-0">
            <thead>
                <tr>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Question</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="p-2 px-3 text-uppercase">Answer</div>
                    </th>
                    <th scope="col" class="border-0 bg-light text-center">
                        <div class="py-2 text-uppercase">Actions</div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($faq as $faq_entry)
                    <tr>
                        <td class="align-middle text-center">
                            <h6>{{ $faq_entry->question }}</h6>
                        </td>
                        <td class="align-middle text-center">
                            <h6>{{ $faq_entry->answer }}</h6>
                        </td>
                        <td class="align-middle">
                            <div class="btn-group-justified btn-group-md">
                                <button type="button" class="btn btn-outline-dark btn-block flex-nowrap" data-toggle="modal" data-target="#faqUpdateModal" data-faq="{{ $faq_entry->id }}">
                                    <i class="fas fa-pen"></i> <span class="d-inline-block">Edit</span>
                                </button>
                                <form class="mt-2" action="{{ route('faqDelete', [$faq_entry->id]) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-red btn-block flex-nowrap">
                                        <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mt-5">
        <div class="ml-auto">
            {{$links}}
        </div>
    </div>

</article>

<div id="faqUpdateModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form class="modal-content" method="post" data-default="{{ url('/admin/faq').'/' }}">
            @csrf
            <div class="modal-header">
                <h4>Update FAQ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-left" id="faqUpdateModal-inputs">
                <label for="faqUpdateModal-question">
                    Question
                </label>
                <input name="question" id="faqUpdateModal-question" class="mx-auto form-control" type="text" placeholder="Question">

                <label for="faqUpdateModal-answer" class="mt-3">
                    Answer
                </label>
                <textarea name="answer" id="faqUpdateModal-answer" type="text" class="mx-auto form-control" placeholder="Answer"></textarea>
            </div>
            <div class="modal-footer">
                <section class="col text-left input-group">
                    <button type="submit" class="btn btn-blue"><i class="fas fa-check mr-2"></i> Confirm </button>
                </section>
                <div class="col text-right">
                    <button type="button" class="btn btn-blue" data-dismiss="modal"><i class="fas fa-times mr-2"></i> Cancel </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="faqAddModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <form class="modal-content" method="post" action="{{ route('faqAdd') }}">
            @csrf
            @method('put')
            <div class="modal-header">
                <h4>Add new FAQ</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-left">
                <label for="faqAddModal-question">
                    Question
                </label>
                <input name="question" id="faqAddModal-question" class="mx-auto form-control" type="text" placeholder="Question">
                <label for="faqAddModal-answer" class="mt-3">
                    Answer
                </label>
                <textarea name="answer" id="faqAddModal-answer" type="text" class="mx-auto form-control" placeholder="Answer"></textarea>
            </div>
            <div class="modal-footer">
                <section class="col text-left input-group"  id="faqAddModal-inputs">
                    <button type="submit" class="btn btn-blue"><i class="fas fa-check mr-2"></i> Confirm </button>
                </section>
                <div class="col text-right">
                    <button type="button" class="btn btn-blue" data-dismiss="modal"><i class="fas fa-times mr-2"></i> Cancel </button>
                </div>
            </div>
        </form>
    </div>
</div>