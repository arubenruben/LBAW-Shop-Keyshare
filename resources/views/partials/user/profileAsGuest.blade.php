<div id="content" class="container">
    <div class="row mt-2">
        <div class="col-sm-4 usercontent-left  border rounded-top">
            <div class="row ">
                <div class="col-sm-12 mt-3">
                    <h4 class="text-center">{{ $user->username }}</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <img class="rounded-circle img-fluid mt-3" src="{{ asset('pictures/profile/'.$user->picture->url) }}" alt="Generic placeholder image" width="250" height="250">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12 text-center">
                    <p><i class="fas fa-thumbs-up cl-success mr-1"></i><span class="font-weight-bold cl-success">{{ $user->rating }}%</span> | <i class="fas fa-shopping-cart"></i> {{ $user->num_sells }}</p>
                </div>
            </div>
            <div class="row mt-2 mb-5">
                <div class="col-sm-12 text-center">
                    <button data-toggle="modal" data-target="#user-{{ $user->id }}" class="btn btn-blue btn-sm mt-2 ">See all feedback</button>
                </div>
            </div>
        </div>
        <div class="col-sm-7 ml-3 text-center border rounded-top-lg">
            <div class="row">
                <div class="col-sm-12 mt-3 text-center">
                    <h4 class="text-center">Account Details</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <form class="needs-validation" novalidate="">
                        <div class="mb-3 mt-3 text-left">
                            <label for="email">Email <span class="text-muted"></span></label>
                            <input type="email" class="form-control userDetailsForm " id="email" value="{{ $user->email }}" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9" disabled>
                            <div class="invalid-feedback">
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="mb-3 text-left">
                            <label for="description">Description</label>
                            <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" maxlength="150" rows="5" disabled>{{ $user->description }}</textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
