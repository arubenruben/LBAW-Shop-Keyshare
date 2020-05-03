<div id="content" class="container">
    <div class="row text-center pt-5">
        <div class="col mb-5">
            <h1> KeyShare FAQ</h1>
        </div>
        <div class="col-10 mx-auto">
            <div class="accordion" id="faq">
                @foreach($faqs as $faq)
                    <div class="card my-2">
                        <div class="card-header p-2" id="faq{{$faq->id}}Q">
                            <h5>
                                <button class="btn btn-link cl-orange2" data-toggle="collapse" data-target="#faq{{$faq->id}}A" aria-expanded="false" aria-controls="faq{{$faq->id}}A">
                                    {{$faq->question}}
                                </button>
                            </h5>
                        </div>

                        <div id="faq{{$faq->id}}A" class="collapse" aria-labelledby="faq{{$faq->id}}Q" data-parent="#faq">
                            <div class="card-body"> <b>Answer:</b> {{$faq->answer}} </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>