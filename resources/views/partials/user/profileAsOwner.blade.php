<div id="content" class="container">
  <div id="modalConfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete account, are you sure?</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-left">
          <span> Confirm </span>
          <input type="text-area" class="form-control userDetailsForm mt-2 d-inline-block" id="exampleFormControlTextarea1" placeholder="Type your username to proceed"></input>
        </div>
        <div class="modal-footer">
          <div class="col text-left"><button class="btn btn-blue"><i class="fas fa-check mr-2"></i>Yes</button></div>
          <div class="col text-right"><button class="btn btn-blue" data-dismiss="modal"><i class="fas fa-times mr-2"></i>Cancel</button></div>
        </div>
      </div>
    </div>
  </div>
  @if($user->banned())

    <div class="row mt-5 mb-2">
      <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
        You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
      </div>
    </div>
  @endif
  <div class="row mt-2">
    <div class="col-sm-4 usercontent-left  border rounded-top">
      <div class="row ">
        <div class="col-sm-12 mt-3">
          <h4 class="text-center">{{ $user->username }}</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 text-center">
          <img class="rounded-circle img-fluid mt-3" src="{{ asset('images/profile/'.$user->image()->url) }}" alt="Profile image" width="250" height="250">
          <form class="mt-3">
            <button type="button" class="btn btn-sm btn-blue"><i class="fas fa-camera-retro"></i> Upload</button>
            <button type="button" class="btn  btn-sm btn-red"><i class="fas fa-trash-alt"></i> Delete</button>
          </form>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-sm-12 text-center">
          <p><i class="fas fa-thumbs-up cl-success mr-1"></i><span class="font-weight-bold cl-success">{{ $user->rating }}%</span> | <i class="fas fa-shopping-cart"></i>{{ $user->num_sells }} </p>
        </div>
      </div>
      <div class="row mt-2 mb-5">
        <div class="col-sm-12 text-center">
          <button type="button" data-toggle="modal" data-target="#userFeedback{{ $user->id }}" class="btn btn-blue btn-sm">See all feedback</button>
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
          <form id="form_update_user" class="needs-validation" novalidate="">
            <div class="mb-3 mt-3 text-left">
              <label for="email">Email <span class="text-muted"></span></label>
              <input  id="email-input" type="email" class="form-control userDetailsForm" id="email" value="{{ $user->email }}" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9" {{ $user->banned() ? 'disabled' : ''}}>
              <div class="text-right mt-3">
                <button id="button_submit_email" type="button" class="btn btn-sm btn-blue" data-container="body" data-toggle="popover" data-trigger="focus" data-content="<span class='cl-success'>Successfully changed your password</span>" data-placement="bottom"><i class="fas fa-envelope"></i> Change email</button>
              </div>
              <div class="invalid-feedback">
                Please enter a valid email.
              </div>
            </div>
            <div class="mb-3 text-left">
              <label for="description">Description</label>
              <textarea id="description_textarea" class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Write something about yourself!!" rows="3" {{ $user->banned() ? 'disabled' : ''}}>{{ $user->description }}</textarea>
              <div class="text-right mt-3">
                <button id="button_submit_description" type="button" class="btn btn-sm btn-blue" {{ $user->banned() ? 'disabled' : ''}}><i class="fas fa-save"></i> Save changes</button>
              </div>
            </div>
            <div class="mb-3 mt-0 text-left">
              <label for="Password ">Password (optional)</label>
              <input id="current-password-input" type="password" class="form-control userDetailsForm mb-1" placeholder="Current password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <input id="new-password-input" type="password" class="form-control userDetailsForm mb-1" placeholder="New password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <input id="confirm-password-input" type="password" class="form-control userDetailsForm mb-1" placeholder="Confirm new password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <div class="text-right mt-3">
                <button id="button_submit_password" type="button" class="btn btn-sm btn-blue" data-container="body" data-toggle="popover" data-trigger="focus" data-content="<span class='cl-success'>Successfully changed your password</span>" data-placement="bottom"><i class="fas fa-key"></i> Change password</button>
              </div>
            </div>
            <div class="mb-5 mt-0 text-left">
              <label for="">Paypal</label>
              <div class="text-right mt-0 flex-nowrap">
                <input id="paypal-input" type="email" class="form-control userDetailsForm mb-3 d-inline-block" value="{{ $user->paypal }}" placeholder="Paypal Email - None" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9" {{ $user->banned() ? 'disabled' : ''}}>
                <button id="paypalButton" type="button" class="btn btn-sm px-4 py-1 btn-outline-primary" {{ $user->banned() ? 'disabled' : ''}}><img src="{{ asset('images/paypal/paypal.png') }}" height="23"></button>
              </div>
            </div>

            <div class="mb-5 mt-5 text-center">
              <span class="invisible">Easter egg</span>
            </div>

            <div class="mb-5 mt-5 text-center flex-nowrap">
              <button id="deleteAccountButton" data-toggle="modal" data-target="#modalConfirm" type="button" class="btn btn-sm btn-blue d-inline-block"><i class="fas fa-user-slash"></i> <span class="d-inline-block"> Delete Account</span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{--   BannAppealPopup   --}}
    <div id="modalAppeal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header row mx-0">
            <div class="col-9 col-md-6">
              <span class="flex-nowrap">
                <h5 class="d-inline-block">Appeal</h5>
              </span>
            </div>
            <div class="col-9 col-md-6 text-right">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
          </div>
          <div class="modal-body">
            <div class="row mt-1">
              <div class="col">
                <h5>An admin will access your situation after you submit an appeal, please be as self explanitory as possible in the comment section</h5>
              </div>
            </div>
            <div class="row mt-3">
              <div class="col">
                <h6>Appeal Coment</h6>
                <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Describe your problem" rows="3"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="col text-right"><button class="btn btn-blue">Submit</button></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
