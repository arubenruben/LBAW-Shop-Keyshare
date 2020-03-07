<?php function drawProduct() { ?>
    <div class="container">
        <div class="row mt-2">
            <div class="col">
                <div class="col-xs-4 item-photo">
                    <img style="max-width:100%;" src="assets/images/gta-v.webp" />
                </div>
            </div>
            <div class="col">
                <div class="col-xs-5" style="border:0px solid gray">
                    <!-- Título do produto -->
                    <h3>Grand Theft Auto V Rockstar Key</h3>

                    <!-- Preço mais baixo -->
                    <h6 class="title-price">Starting at:</h6>
                    <h4 style="margin-top:0px;">US$ 39.99</h4>

                    <!-- Detalhes específicos do produto -->
                    <div class="section">
                        <p>Grand Theft Auto V is a 2013 action-adventure game developed by Rockstar North and published
                            by Rockstar Games. It is the first main entry in the Grand Theft Auto series since 2008's
                            Grand Theft Auto IV. Set within the fictional state of San Andreas, based on Southern
                            California, the single-player story follows three criminals and their efforts to commit
                            heists while under pressure from a government agency and powerful crime figures. The open
                            world design lets players freely roam San Andreas' open countryside and the fictional city
                            of Los Santos, based on Los Angeles. </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="section mt-5">
            <h3>Offers: 2</h3>

            <div class="row mt-4">
                <div class="col-md-7">
                    <h4>bestseller439</h4>
                    <p>
                        Rating: <span class="font-weight-bold cl-success">99%</span>
                         | <i class="fas fa-shopping-cart"></i> 1897 | Stock: 10 keys</p>
                </div>
                <div class="col-md-2 text-right mt-2">
                    <h4>39.99 US$</h4>
                </div>
                <div class="col-md-3">
                    <button class="btn bg-interactive"><i
                            class="fas fa-shopping-cart"></i> Add to Cart</button>
                </div>
            </div>
            <hr style="margin: 0">
            <div class="row mt-4">
                <div class="col-md-7">
                    <h4>worstseller712</h4>
                    <p>
                        Rating: <span class="font-weight-bold cl-fail">43%</span>
                         | <i class="fas fa-shopping-cart"></i> 24 | Stock: 1 keys
                    </p>
                </div>
                <div class="col-md-2 text-right mt-2">
                    <h4>49.99 US$</h4>
                </div>
                <div class="col-md-3">
                    <button class="btn hv-interactive bg-interactive"><i
                            class="fas fa-shopping-cart"></i> Add to Cart</button>
                </div>
            </div>
            
        </div>
        <hr class="m-0">
    </div>        
<?php } ?>

<?php function drawFeedbackPopup() { ?>
<!-- Button trigger modal -->
    <a class="btn" data-toggle="modal" data-target="#exampleModalLong">
        Launch demo modal
    </a>

  	<!-- Modal -->
	<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
						<div class="row">
							<div class="col">
								<h4>bestseller439</h4>
								<span>99% Positive Feedback | Sales: 1897</span> 
							</div>
						</div>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- modal body -->
				<div class="modal-body">
					<div class="container-fluid">
						<!-- feedback header -->
						<div class="row">
							<div class="col">
								<div class="btn"> All reviews</div>
							</div>
							<div class="col">
								<h8> <i class="fas fa-thumbs-up"></i>Positive reviews</h8>
							</div>
							<div class="col">
								<h8> <i class="fas fa-thumbs-down"></i>Negative reviews</h8>
							</div>
						</div>
						<!-- feedback ratings -->
						<div class="row">
							<div class="col">
								<i class="fas fa-thumbs-down"></i>
								<i class="fas fa-thumbs-up"></i>
							</div>
							<div class="col">
								Mar 06, 2020
							</div>
							<div class="col">
								key doesnt work
							</div>
						</div>
						<div class="row">
							<div class="col">
								<i class="fas fa-thumbs-up"></i>
							</div>
							<div class="col">
								Mar 06, 2020
							</div>
							<div class="col">
								key works
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary">Load More</button>
				</div>
			</div>
		</div>
	</div>
<?php } ?>