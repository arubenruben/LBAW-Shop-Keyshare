<div id="content" class="container">
  <div id="modalConfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete account, are you sure?</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-left">
          <span> Confirm </span>
          <input id="delete-account-confirmation-input" type="text-area"
                 class="form-control userDetailsForm mt-2 d-inline-block" id="exampleFormControlTextarea1"
                 placeholder="Type your username to proceed"/>
        </div>
        <div class="modal-footer">
          <div class="col text-left">
            <button id="delete-account-confirmation" class="btn btn-blue">
              <i class="fas fa-check mr-2"></i>Yes
            </button>
          </div>
          <div class="col text-right"><button class="btn btn-blue" data-dismiss="modal">
              <i class="fas fa-times mr-2"></i>Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  @if($user->isBanned()) @include('partials.user.ban_appeal') @endif

  <div class="row mt-2">
    <div class="col-sm-4 usercontent-left  border rounded-top">
      <div class="row ">
        <div class="col-sm-12 mt-3">
          <h4 class="text-center">{{ $user->username }}</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 text-center">
          <img id="profile-image" class="rounded-circle img-fluid mt-3"
            src="{{ asset('pictures/profile/'.$user->picture->url) }}" alt="Profile image">
          <section class="row justify-content-center mt-3">
            <form id="form-img-upload" name="user-image-form" enctype="multipart/form-data">
              @csrf
              <span class="btn btn-sm btn-blue btn-file">
                <i class="fas fa-camera-retro"></i>
                Browse <input id="img-upload" name="picture" type="file">
              </span>
            </form>
            <form action={{route('deleteProfilePicture')}} method="POST" class="ml-3">
              @csrf @method('DELETE')
              <button type="submit" class="btn  btn-sm btn-red"><i class="fas fa-trash-alt"></i>
                Delete</button>
            </form>
          </section>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-sm-12 text-center">
          <p>@if($user->rating != null) <i class="fas fa-thumbs-up cl-success mr-1"></i> @endif
            <span class="font-weight-bold cl-success">
              @if($user->rating == null) {{ 'No rating yet!'  }}
              @else {{ $user->rating }}%
              @endif
            </span> | <span><i class="fas fa-shopping-cart"></i>{{ $user->num_sells }}</span>
          </p>
        </div>
      </div>
      <div class="row mt-2 mb-5">
        <div class="col-sm-12 text-center">
          <button type="button" data-toggle="modal" data-target="#user-{{ $user->id }}" class="btn btn-blue btn-sm">See all feedback</button>
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
            @csrf
            <div class="mb-3 mt-3 text-left">
              <label for="email">Email <span class="text-muted"></span></label>
              <input id="email-input" type="email" class="form-control userDetailsForm" id="email"
                value="{{ $user->email }}" placeholder="youremail@example.com" data-kwimpalastatus="alive"
                data-kwimpalaid="1583446459119-9" {{ $user->isBanned() ? 'disabled' : ''}}>
              <div id="email-invalid" class="invalid-feedback d-block"> </div>
              <div id="email-valid" class="valid-feedback d-block"> </div>
              <div class="text-right mt-3">
                <button id="button_submit_email" type="button" class="btn btn-sm btn-blue">
                  <i class="fas fa-envelope"></i> Change email
                </button>
              </div>

            </div>
            <div class="mb-3 text-left">
              <label for="description">Description</label>
              <textarea id="description_textarea" class="form-control userDetailsForm" id="exampleFormControlTextarea1"
                placeholder="Write something about yourself!!" rows="3"
                {{ $user->isBanned() ? 'disabled' : ''}}>{{ $user->description }}</textarea>
              <div id="description-invalid" class="invalid-feedback">   </div>
              <div id="description-valid" class="valid-feedback">   </div>
              <div class="text-right mt-3">
                <button id="button_submit_description" type="button" class="btn btn-sm btn-blue"
                  {{ $user->isBanned() ? 'disabled' : ''}}><i class="fas fa-save"></i> Save changes
                </button>
              </div>
            </div>

            <div class="mb-3 mt-0 text-left">
              <label for="Password ">Password (optional)</label>
              <input id="old-password-input" type="password" class="form-control userDetailsForm mb-1"
                placeholder="Current password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <div id="old-password-invalid" class="invalid-feedback"> </div>
              <input id="new-password-input" type="password" class="form-control userDetailsForm mb-1"
                placeholder="New password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <input id="confirm-password-input" type="password" class="form-control userDetailsForm mb-1"
                placeholder="Confirm new password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <div id="new-password-invalid" class="invalid-feedback d-block">   </div>
              <div id="new-password-valid" class="valid-feedback">   </div>
            </div>
            <div class="text-right mt-3">
              <button id="button_submit_password" type="button" class="btn btn-sm btn-blue">
                <i class="fas fa-key"></i> Change password
              </button>
            </div>

            <div class="mb-5 mt-5 text-center">
              <span class="invisible">Easter egg</span>
            </div>
            <div class="mb-5 mt-5 text-center flex-nowrap">
              <button id="deleteAccountButton" data-toggle="modal" data-target="#modalConfirm" type="button"
                class="btn btn-sm btn-blue d-inline-block">
                <i class="fas fa-user-slash"></i>
                <span class="d-inline-block"> Delete Account</span></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>