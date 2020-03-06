<?php function drawHomepage() { ?>
	<div id="homepage" class="container" style="width: 80%">
		<div class="col">
			<!-- carousel -->
			<div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
				<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
				<div class="carousel-item active">
					<img class="d-block img-fluid" src="../../assets/images/fifa19.JPG" alt="First slide">
				</div>
				<div class="carousel-item">
					<img class="d-block img-fluid" src="../../assets/images/fifa19.JPG" alt="Second slide">
				</div>
				<div class="carousel-item">
					<img class="d-block img-fluid" src="images/3.png" alt="Third slide">
				</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
				</a>
			</div>
			
			<!-- most popular -->
			<div class="row mt-5" style="background-color: aqua;">
				<div class="col sm-3">
					<div class="row mt-2">
						<h5 class="title col-xs-4"> Most popular <a href=""><small> See all</small></a> </h5>
					</div>
				</div>
				<div class="col sm-3 text-right">
					<button id="side-btn" type="button" class="btn btn-light col-xs-9" style="border-radius: 50%;"><i class="fas fa-angle-left"></i></button>
					<button id="side-btn" type="button" class="btn btn-light col-xs-4" style="border-radius: 50%;"><i class="fas fa-angle-right"></i></button>
				</div>
			</div>
			<div id="most-popular" class="row mt-2">
					<div class="col-sm-2">
						<div class="card h-100">
							<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
							<div class="card-body">
								<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
								<h5>$24.99</h5>
							</div>
						</div>
					</div>

					<div class="col-sm-2">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
	
					<div class="col-sm-2">
						<div class="card h-100">
							<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
							<div class="card-body">
								<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
								<h5>$24.99</h5>
							</div>
						</div>
					</div>
	
					<div class="col-sm-2">
						<div class="card h-100">
							<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
							<div class="card-body">
								<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
								<h5>$24.99</h5>
							</div>
						</div>
					</div>
	
					<div class="col-sm-2">
						<div class="card h-100">
							<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
							<div class="card-body">
								<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
								<h5>$24.99</h5>
							</div>
						</div>
					</div>
	
					<div class="col-sm-2">
						<div class="card h-100">
							<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
							<div class="card-body">
								<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
								<h5>$24.99</h5>
							</div>
						</div>
					</div>
			</div>
			
			<!-- most recent -->
			<div class="row mt-5" style="background-color: aqua;">
				<div class="col sm-3">
					<div class="row mt-2">
						<h5 class="title col-xs-4"> Most recent <a href=""><small> See all</small></a> </h5>
					</div>
				</div>
				<div class="col sm-3 text-right">
					<button id="side-btn" type="button" class="btn btn-light col-xs-9" style="border-radius: 50%;"><i class="fas fa-angle-left"></i></button>
					<button id="side-btn" type="button" class="btn btn-light col-xs-4" style="border-radius: 50%;"><i class="fas fa-angle-right"></i></button>
				</div>
			</div>
			<div id="most-recent" class="row mt-2">
				<div class="col-sm-2">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>

				<div class="col-sm-2">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>