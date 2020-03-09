<?php function drawAdminStart() { ?>

    <section class="aboutus py-5" id="aboutus">
        <div id="content" class="container-fluid">
            <div class="row">

<?php } ?>

<?php function drawAdminInterface() { ?>

    <div class="col-md-3">
        <div class="card">
            <div class="">
                <!-- <h4 class="pl-3 py-2">Categories</h4> -->
                <ul class="list-unstyled">
                    <li><a href="" class="list-group-item  bg-active"><i class="fa fa-tachometer"></i> Home </a> </li>
                    <li><a href="" class="list-group-item"> Products </a> </li>
                    <li><a href="" class="list-group-item"> Categories </a> </li>
                    <li><a href="" class="list-group-item"> Genres </a> </li>
                    <li><a href="" class="list-group-item"> Platforms </a> </li>
                    <li><a href="" class="list-group-item"> Users </a> </li>
                    <li><a href="" class="list-group-item"> Reports </a> </li>
                    <li><a href="" class="list-group-item"> Transactions </a> </li>
                    <li><a href="" class="list-group-item"> Reviews </a> </li>
                    <li><a href="" class="list-group-item"> FAQ </a> </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-9">

<?php }

function drawAdminEnd() { ?>

                </div>
            </div>
        </div>
    </section>

<?php }

function drawAdminHomePage() { ?>

    <div class="card mb-4">
        <h4 class="pl-3 py-2">Tasks to be done:</h4>
        <p class="pl-5 py-2">Unseen Reports: 2</p>
        <p class="pl-5 py-2">Active Reports: 5</p>
    </div>
    <div class="card mb-4">
        <h4 class="pl-3 py-2">Daily Statistics</h4>
        <p class="pl-5 py-2">Transactions made: 51</p>
        <p class="pl-5 py-2">Money made: 200 US$</p>
    </div>
    <div class="card mb-4">
        <h4 class="pl-3 py-2">Monthly Statistics</h4>
        <p class="pl-5 py-2">Transactions made: 782</p>
        <p class="pl-5 py-2">Money made: 3491 US$</p>
    </div>

<?php } ?>