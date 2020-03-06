<?php
include_once('../templates/common.php');

drawHead();
drawHeader(0);
drawNavbar(0);
?>



<ul class="nav nav-pills  justify-content-center p-2  bg-dark text-white">
    <li class="nav-item">
        <a class="nav-link  active deco-none" href="userPage.php">Account</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  deco-none" href="userPurchasesPage.php">Purchases</a>
    </li>
    <li class="nav-item">
        <a class="nav-link  deco-none" href="userOffers.php">Offers(7)</a>
    </li>
</ul>
</ul>

<div class="container">

  <div class="row mt-5">

    <div class="col-sm-4 usercontent-left  border rounded-top">
      <div class="row ">
        <div class="col-sm-12">
          <h4 class="text-center">Username</h4>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 text-center">
          <img class="rounded-circle img-fluid mt-3" src="https://scontent.flis7-1.fna.fbcdn.net/v/t1.0-9/22141173_826758350835332_1211921233867541017_n.jpg?_nc_cat=100&_nc_sid=85a577&_nc_ohc=FxTK4QbD1iIAX_KPa6o&_nc_ht=scontent.flis7-1.fna&oh=f273076c731a0cde48a147e1bc1c0308&oe=5E835F94" alt="Generic placeholder image" width="250" height="250">
          <form class="mt-3">
            <button type="button" class="btn btn-outline-primary"><i class="fas fa-camera-retro"></i> Upload</button>
            <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i> Delete</button>
          </form>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-sm-12 text-center">
          <span class="mt-5"> 100 % positive feedback | 4000 <i class="fas fa-shopping-cart"></i></span>
        </div>
      </div>

      <div class="row mt-2 mb-5">
        <div class="col-sm-12 text-center">
          <button type="button" class="btn btn-primary btn-sm mt-2">See all feedback</button>
        </div>
      </div>
    </div>


    <div class="col-sm-7 ml-3 text-center border rounded-top-lg">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h4 class="text-center">Account Details</h4>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12 text-center">
          <form class="needs-validation" novalidate="">

            <div class="mb-3 mt-3">
              <label for="email">Email <span class="text-muted"></span></label>
              <input type="email" class="form-control userDetailsForm" id="email" placeholder="youremail@example.com" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <div class="invalid-feedback">
                Please enter a valid email.
              </div>
            </div>

            <div class="mb-3">
              <label for="description">Description</label>
              <textarea class="form-control userDetailsForm" id="exampleFormControlTextarea1" placeholder="Write something about yourself!!" rows="3"></textarea>
              <div class="text-right mt-3">
                <button type="button" class="btn btn-primary"><i class="fas fa-save"></i> Save changes</button>
              </div>
            </div>



            <div class="mb-3 mt">
              <label for="Password">Password (optional)</label>
              <input type="password" class="form-control userDetailsForm mb-1" placeholder="Current password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <input type="password" class="form-control userDetailsForm mb-1" placeholder="New password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <input type="password" class="form-control userDetailsForm mb-1" placeholder="Confirm new password" data-kwimpalastatus="alive" data-kwimpalaid="1583446459119-9">
              <div class="text-right mt-3">
                <button type="button" class="btn btn-primary"><i class="fas fa-key"></i> Change password</button>
              </div>
              <div class="invalid-feedback">
                Please enter your shipping address.
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>


  </div>
  <div class="row">
    <div class="col-sm-12 text-center">
      <div class="mt-5 mb-5 accountDelete-button">
        <button type="button mt-5 mb-5 accountDelete-button" class="btn btn-md btn-danger"><i class="fas fa-user-times"></i> Delete account</button>
      </div>
    </div>
  </div>
</div>


<!-- /.container -->
<?php drawFooter(); ?>