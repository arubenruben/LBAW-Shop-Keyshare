<?php function drawHomepage()
{ ?>
	<div id="content" class="container">
		<!-- carousel -->
		<div class="row mx-3 my-4">
			<div id="carouselExampleIndicators" class="carousel slide ml-auto mr-auto" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<a href="product.php"><img src="../../../public/images/games/carousel/1.jpg" class="d-block w-100"></a>
					</div>
					<div class="carousel-item">
						<a href="product.php"><img src="../../../public/images/games/carousel/1.jpg" class="d-block w-100"></a>
					</div>
					<div class="carousel-item">
						<a href="product.php"><img src="../../../public/images/games/carousel/1.jpg" class="d-block w-100"></a>
					</div>
				</div>
				<a id="carouselArrowLeft" class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a id="carouselArrowRight" class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<!-- most popular -->
		<div class="row ml-3">
			<div class="col-8 pl-0">
                <h5 class="title"> Most Popular <a href="products_list.php"><small class="ml-3 d-inline-block"> See all</small></a></h5>
			</div>
			<div class="col-4 pl-0 d-flex justify-content-end my-auto mw-100 mh-100">
                <button id="side-btn" type="button" class="btn btn-light rounded-circle" onclick="blur();"><i class="fas fa-angle-left"></i></button>
                <button id="side-btn1" type="button" class="btn btn-light rounded-circle" onclick="blur();"><i class="fas fa-angle-right"></i></button>
			</div>
		</div>
		<div class="col mb-5">
			<div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto">
				<div class="card col-8 col-sm-5 col-md-3 col-lg-3 col-xl-2 mx-auto mx-sm-0 cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/GTAV/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">GTA V</a></h6>
						<h5 class="cl-orange2">$24.99</h5>
					</div>
				</div>
				<div class="card col-8 col-sm-5 col-md-3 col-lg-3 col-xl-2 mx-auto mx-sm-0 d-sm-block d-none cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/FIFA20/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">FIFA20</a></h6>
						<h5 class="cl-orange2">$30</h5>
					</div>
				</div>
				<div class="card  col-8 col-sm-5 col-md-3 col-lg-3 col-xl-2 mx-auto mx-sm-0  d-md-block d-none cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/MINECRAFT/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Minecraft</a></h6>
						<h5 class="cl-orange2">$19.99</h5>
					</div>
				</div>
				<div class="card  col-xl-2 mx-auto mx-sm-0 d-xl-block d-none cardHomepage">
					<a href=" product.php"><img class="card-img-top cardHomepageImg img-fluid " src="../../../public/images/games/WATCHDOGS/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">CSGO</a></h6>
						<h5 class="cl-orange2">$24.99</h5>
					</div>
				</div>
				<div class="card   col-xl-2 mx-auto mx-sm-0 d-xl-block d-none cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/FORZAHORIZON4/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Forza Horizon 4</a></h6>
						<h5 class="cl-orange2">$10</h5>
					</div>
				</div>
			</div>
		</div>
		<!-- most recent -->
		<div class="row mt-5 ml-3">
        <div class="col-8 pl-0">
                <h5 class="title"> Most Recents <a href="products_list.php"><small class="ml-3 d-inline-block"> See all</small></a></h5>
			</div>
			<div class="col-4 pl-0 d-flex justify-content-end my-auto mw-100 mh-100">
                <button id="side-btn" type="button" class="btn btn-light rounded-circle ml-auto" onclick="blur();"><i class="fas fa-angle-left"></i></button>
                <button id="side-btn1" type="button" class="btn btn-light rounded-circle" onclick="blur();"><i class="fas fa-angle-right"></i></button>
			</div>
		</div>
		<div class="col mb-5">
			<div class="row justify-content-between flex-nowrap mt-2 ml-auto mr-auto">
				<div class="card col-8 col-sm-5 col-md-3 col-lg-3 col-xl-2 mx-auto mx-sm-0 cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/ASSASSINSCREEDUNITY/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Assassins Creed Unity</a></h6>
						<h5 class="cl-orange2">$24.99</h5>
					</div>
				</div>
				<div class="card col-8 col-sm-5 col-md-3 col-lg-3 col-xl-2 mx-auto mx-sm-0 d-sm-block d-none cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/STARWARSJEDIFALLENORDER/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Star Wars Jedi Fallen Order</a></h6>
						<h5 class="cl-orange2">$30</h5>
					</div>
				</div>
				<div class="card col-8 col-sm-5 col-md-3 col-lg-3 col-xl-2 mx-auto mx-sm-0  d-md-block d-none cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/CSGO/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">CSGO</a></h6>
						<h5 class="cl-orange2">$19.99</h5>
					</div>
				</div>
				<div class="card  col-xl-2 mx-auto mx-sm-0 d-xl-block d-none cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/MINECRAFT/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">Minecraft</a></h6>
						<h5 class="cl-orange2">$24.99</h5>
					</div>
				</div>
				<div class="card  col-xl-2 mx-auto mx-sm-0  d-xl-block d-none cardHomepage">
					<a href="product.php"><img class="card-img-top cardHomepageImg img-fluid" src="../../../public/images/games/GTAV/1.png"></a>
					<div class="card-body">
						<h6 class="card-title"> <a href="product.php" class="text-decoration-none text-secondary">GTA V</a></h6>
						<h5 class="cl-orange2">$10</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>