<?php function drawHomepage()
{ ?>
	<div id="homepage" class="container">
		<div class="col">
			<!-- carousel -->
			<div id="carouselExampleIndicators" class="carousel bg-orange slide my-4" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner" role="listbox">
					<div class="carousel-item active">
						<img class="d-block img-fluid" src="../../assets/images/games/example1/example1.jpg" alt="First slide">
					</div>
					<div class="carousel-item">
						<img class="d-block img-fluid" src="../../assets/images/games/example/example.png" alt="Third slide">
					</div>
					<div class="carousel-item">
						<img class="d-block img-fluid" src="../../assets/images/games/fifa19/fifa19_carousel.jpg" alt="Third slide" max-width="900">
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
			<div class="row mt-5">
				<div class="col sm-3">
					<div class="row mt-2">
						<h5 class="title ml-3"> Most popular <a href="products_list.php"><small class="ml-3"> See all</small></a> </h5>
					</div>
				</div>
				<div class="col sm-3 text-right">
					<button id="side-btn" type="button" class="btn btn-light rounded-circle" onclick="this.blur();"><i class="fas fa-angle-left"></i></button>
					<button id="side-btn" type="button" class="btn btn-light rounded-circle" onclick="this.blur();"><i class="fas fa-angle-right"></i></button>
				</div>
			</div>
			<div id="most-popular" class="row mt-2">
				<div class="col-sm-2 d-xl-block">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF" width="250" height="200"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
			</div>

			<!-- most recent -->
			<div class="row mt-5">
				<div class="col sm-3">
					<div class="row mt-2">
						<h5 class="title ml-3"> Most recent <a href="products_list.php"><small class="ml-3"> See all</small></a> </h5>
					</div>
				</div>
				<div class="col sm-3 text-right">
					<button id="side-btn" type="button" class="btn btn-light rounded-circle" onclick="this.blur();"><i class="fas fa-angle-left"></i></button>
					<button id="side-btn" type="button" class="btn btn-light rounded-circle" onclick="this.blur();"><i class="fas fa-angle-right"></i></button>
				</div>
			</div>
			<div id="most-recent" class="row mt-2">
				<div class="col-sm-2 d-xl-block">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2 d-xl-block d-none">
					<div class="card h-100 ">
						<a href="#"><img class="card-img-top" src="../../assets/images/fifa19.JPG" alt=""></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#" class="text-dark text-decoration-none"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<!-- CAROUSEL: 3440x1440 -->
<!-- PRODUCT HOMEPAGE: 3440x1440 -->
<!-- LISTINGS: 1920*1080 -->
