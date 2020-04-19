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
  <?php if($type == "banned"){?>
  <div class="row mt-5 mb-2">
    <div class="col-7 hoverable color:red text-center mx-auto alert alert-danger" role="alert" data-toggle="modal" data-target="#modalAppeal">
      You are currently banned! Some functionalities are disabled. <strong>Click to appeal</strong>
    </div>
  </div>
  <?php }?>
  <div class="row mt-2">
    <div class="col-sm-4 usercontent-left  border rounded-top">
      <div class="row ">
        <div class="col-sm-12 mt-3">
          <h4 class="text-center">Username</h4>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 text-center">
          <img class="rounded-circle img-fluid mt-3" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="250" height="250">
          <form class="mt-3">
            <button type="button" class="btn btn-sm btn-blue"><i class="fas fa-camera-retro"></i> Upload</button>
            <button type="button" class="btn  btn-sm btn-red"><i class="fas fa-trash-alt"></i> Delete</button>
          </form>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-sm-12 text-center">
          <p><i class="fas fa-thumbs-up cl-success mr-1"></i><span class="font-weight-bold cl-success">100%</span> | <i class="fas fa-shopping-cart"></i> 4000 </p>
        </div>
      </div>
      <div class="row mt-2 mb-5">
        <div class="col-sm-12 text-center">
          <button type="button" data-toggle="modal" data-target=".bd-modal-lg1" class="btn btn-blue btn-sm">See all feedback</button>
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
              <?php if($type == "banned"){?>
              <input type="email" class="form-control userDetailsForm" id="email" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9" disabled>
              <?php }
              else{?>
              <input type="email" class="form-control userDetailsForm" id="email" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <?php } ?>


              <div class="invalid-feedback">
                Please enter a valid email.
              </div>
            </div>
            <div class="mb-3 text-left">
              <label for="description">Description</label>
              <?php if($type == "banned"){?>
              <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Write something about yourself!!" rows="3" disabled></textarea>
              <?php }
              else{?>
              <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Write something about yourself!!" rows="3"></textarea>
              <?php } ?>

              <div class="text-right mt-3">
                <?php if($type == "banned"){?>
                <button type="button" class="btn btn-sm btn-blue" disabled><i class="fas fa-save"></i> Save changes</button>
                <?php }
                else{?>
                <button type="button" class="btn btn-sm btn-blue"><i class="fas fa-save"></i> Save changes</button>
                <?php } ?>

              </div>
            </div>
            <div class="mb-3 mt-0 text-left">
              <label for="Password ">Password (optional)</label>
              <input type="password" class="form-control userDetailsForm mb-1" placeholder="Current password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <input type="password" class="form-control userDetailsForm mb-1" placeholder="New password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <input type="password" class="form-control userDetailsForm mb-1" placeholder="Confirm new password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <div class="text-right mt-3">
                <button type="button" class="btn btn-sm btn-blue" data-container="body" data-toggle="popover" data-trigger="focus" data-content="<span class='cl-success'>Successfully changed your password</span>" data-placement="bottom"><i class="fas fa-key"></i> Change password</button>
              </div>
            </div>
            <div class="mb-5 mt-0 text-left">
              <label for="">Paypal</label>
              <div class="text-right mt-0 flex-nowrap">
                <input type="password" class="form-control userDetailsForm mb-3 d-inline-block" placeholder="Paypal Email - None" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9" disabled>
                <?php if($type == "banned"){?>
                <button id="paypalButton" type="button" class="btn btn-sm px-4 py-1 btn-outline-primary" disabled><img src="../../../public/images/paypal/paypal.png" height="23"></button>
                <?php }
                else{?>
                <button id="paypalButton" type="button" class="btn btn-sm px-4 py-1 btn-outline-primary"><img src="../../../public/images/paypal/paypal.png" height="23"></button>
                <?php } ?>

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
    <?php drawAppealPopup() ?>
  </div>
</div>
