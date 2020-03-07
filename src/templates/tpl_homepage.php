<?php
include_once('../templates/tpl_common.php');

function drawHomepage()
{ ?>
	<div id="wrapper">
		<div id="content" class="container">
			<div class="row mt-4 mr-2 ml-2">
				<div id="carouselExampleIndicators" class="carousel slide ml-auto mr-auto" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
						<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="../assets/images/car1.jpg" class="d-block w-100">
						</div>
						<div class="carousel-item">
							<img src="../assets/images/car1.jpg" class="d-block w-100">
						</div>
						<div class="carousel-item">
							<img src="../assets/images/car1.jpg" class="d-block w-100">
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
			</div>
			<div class="row mt-5">
				<div class="col">
					<div class="row mt-2">
						<h5 class="title"> Most Popular <a href="listings.php"><small class="ml-3"> See all</small></a></h5>
					</div>
				</div>
				<div class="col mr-4">
					<div class="row">
						<button id="side-btn" type="button" class="btn btn-light rounded-circle ml-auto"><i class="fas fa-angle-left"></i></button>
						<button id="side-btn1" type="button" class="btn btn-light rounded-circle"><i class="fas fa-angle-right"></i></button>
					</div>
				</div>
			</div>
			<div class="col mb-5 homepageProductCol">
				<div class="row justify-content-between flex-nowrap mt-4 ml-auto mr-auto">
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-4 col-xl-2 h-100">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-4 col-xl-2 h-100">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-4 h-100 col-xl-2 d-md-block d-none">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-2 h-100 d-xl-block d-none">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-2 h-100 d-xl-block d-none">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-2 h-100 d-xl-block d-none">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt-5">
				<div class="col">
					<div class="row">
						<h5 class="title"> Most Recents <a href="listings.php"><small class="ml-3"> See all</small></a></h5>
					</div>
				</div>
				<div class="col mr-4">
					<div class="row">
						<button id="side-btn" type="button" class="btn btn-light rounded-circle ml-auto"><i class="fas fa-angle-left"></i></button>
						<button id="side-btn1" type="button" class="btn btn-light rounded-circle"><i class="fas fa-angle-right"></i></button>
					</div>
				</div>
			</div>
			<div class="col mb-5">
				<div class="row justify-content-between flex-nowrap mt-4 ml-auto mr-auto">
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-4 col-xl-2 h-100">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-4 col-xl-2 h-100">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-4 h-100 col-xl-2 d-md-block d-none">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-2 h-100 d-xl-block d-none">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-2 h-100 d-xl-block d-none">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
					<div class="card gameListItem col-xs-6 col-sm-4 col-md-2 h-100 d-xl-block d-none">
						<a href="#"><img class="card-img-top mt-3" src="https://www.google.com/url?sa=i&url=http%3A%2F%2Ft1.gstatic.com%2Fimages%3Fq%3Dtbn%3AANd9GcQjo-dsEHtYUyuTPNn-PfW6roSHQeX9Lqp1lpBk5pOS5bOVTm1-&psig=AOvVaw06kRgRtzZeEZq60HXOw0lu&ust=1583502457922000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIijz728g-gCFQAAAAAdAAAAABAF"></a>
						<div class="card-body">
							<h6 class="card-title"> <a href="#"> Star Wars Jedi: Fallen Order </a> </h6>
							<h5>$24.99</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php drawFooter() ?>
	</div>
<?php } ?>