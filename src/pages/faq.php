<?php
	//includes
	include_once('../templates/tpl_common.php');
	include_once('../templates/tpl_faq.php');
	//page
	drawHead();
	//drawHeader(0);
    //drawFAQ();
    //drawFooter();
?>


<div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<!-- authentication popup header -->
        <div class="bs-example bs-example-tabs">
            <ul id="myTab" class="nav nav-tabs">
              <li class="active ml-auto mr-auto my-2"><a href="#signin" class="cl-orange" data-toggle="tab">Sign In</a></li>
              <li class="ml-auto mr-auto my-2"><a href="#signup" class="cl-orange" data-toggle="tab">Sign Up</U></a></li>
            </ul>
        </div>
		<!-- modal body-->
		<div class="modal-body">
			<div id="myTabContent" class="tab-content">
				<div class="tab-pane fade active in" id="signin">
					<form class="form-horizontal">
					<fieldset>
						<!-- Sign In Form -->
						<!-- Text input-->
						<div class="control-group">
							<label class="control-label" for="userid">Username:</label>
							<div class="controls">
								<input required="" id="userid" name="userid" type="text" class="form-control" placeholder="username" class="input-medium" required="">
							</div>
						</div>
						<!-- Password input-->
						<div class="control-group mt-4 mb-2">
							<label class="control-label" for="passwordinput">Password:</label>
							<div class="controls">
								<input required="" id="passwordinput" name="passwordinput" class="form-control" type="password" placeholder="********" class="input-medium">
							</div>
						</div>
						<!-- Button -->
						<div class="control-group">
							<label class="control-label" for="signin"></label>
							<div class="controls text-center">
								<button id="signin" name="signin" class="btn text-light btn-orange">Sign In</button>
							</div>
						</div>
					</fieldset>
					</form>
				</div>
				<div class="tab-pane fade" id="signup">
					<form class="form-horizontal">
					<fieldset>
						<!-- Sign Up Form -->	
						<!-- Text input-->
						<div class="control-group">
							<label class="control-label" for="userid">Username:</label>
							<div class="controls">
								<input required="" id="userid" name="userid" type="text" class="form-control" placeholder="username" class="input-medium" required="">
							</div>
						</div>
						
						<!-- Password input -->
						<div class="control-group mt-4 mb-2">
							<label class="control-label" for="passwordinput">Password:</label>
							<div class="controls">
								<input required="" id="passwordinput" name="passwordinput" class="form-control" type="password" placeholder="********" class="input-medium">
							</div>
						</div>
						
						<!-- Confirm Password input-->
						<div class="control-group">
						<label class="control-label" for="reenterpassword">Re-Enter Password:</label>
						<div class="controls">
							<input id="reenterpassword" class="form-control" name="reenterpassword" type="password" placeholder="********" class="input-large" required="">
						</div>
						</div>

						<!-- Button -->
						<div class="control-group">
							<label class="control-label" for="confirmsignup"></label>
							<div class="controls text-center">
								<button id="confirmsignup" name="confirmsignup" class="btn text-light btn-orange">Sign Up</button>
							</div>
						</div>
					</fieldset>
					</form>
				</div>
			</div>
		</div>

		<div class="modal-footer">
			<button type="button" class="btn" data-dismiss="modal">Close</button>
		</div>
    </div>
  </div>
</div>

<button class="btn btn-primary btn-lg" href="#signup" data-toggle="modal" data-target=".bs-modal-sm">Sign In/Register</button>