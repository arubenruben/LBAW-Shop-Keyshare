<?php function drawAdminStart() { ?>

    <section class="aboutus py-5" id="aboutus">
        <div id="content" class="container-fluid">
            <div class="row">

<?php } ?>

<?php function drawAdminInterface() { ?>

    <div class="col-md-3 mt-4">
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

    <div class="card my-4">
        <h4 class="pl-3 py-2">Tasks to be done:</h4>
        <p class="pl-5 py-2">Unseen Reports: 2</p>
        <p class="pl-5 py-2">Active Reports: 5</p>
    </div>
    <div class="card my-4">
        <h4 class="pl-3 py-2">Daily Statistics</h4>
        <p class="pl-5 py-2">Transactions made: 51</p>
        <p class="pl-5 py-2">Money made: 200 US$</p>
    </div>
    <div class="card my-4">
        <h4 class="pl-3 py-2">Monthly Statistics</h4>
        <p class="pl-5 py-2">Transactions made: 782</p>
        <p class="pl-5 py-2">Money made: 3491 US$</p>
    </div>

<?php } 

function drawAdminSkeletonTable() { ?>

    <h3>Products</h3>
    <div class="table-responsive table-striped mt-3">
    <table id="userOffersTable" class="table p-0">
        <thead>
            <tr>
                <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Name</div>
                </th>
                <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Image</div>
                </th>

                <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Description</div>
                </th>
                <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Category</div>
                </th>
                <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Genres</div>
                </th>
                <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Platform</div>
                </th>
                <th scope="col" class="border-0 bg-light text-center">
                    <div class="py-2 text-uppercase">Actions</div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center align-middle">GTA V</td>
                <td scope="row" class="border-0 align-middle">
                        <img src="../../assets/images/games/GTAV/1.png" alt="" width="150" class="p-2 img-fluid rounded d-none d-sm-inline userOffersTableEntryImage">
                </td>
                <td class="text-justify align-middle">Grand Theft Auto V is a action-adventure game developed by Rockstar North and published by Rockstar Games. Set within the fictional state of San Andreas, based on Southern California, the single-player story follows three criminals and their efforts to commit heists while under pressure from a government agency and powerful crime figures. The open world design lets players freely roam San Andreas' open countryside and the fictional city of Los Santos, based on Los Angeles.</td>
                <td class="text-center align-middle">Game</td>
                <td class="text-center align-middle">Action Open World</td>
                <td class="text-center align-middle">PC</td>
                <td class="align-middle">
                    <div class="btn-group-justified btn-group-md">
                        <button href="offer.php" class="btn btn-blue btn-block flex-nowrap">
                             <i class="fas fa-edit d-inline-block"></i> <span class="d-none d-md-inline-block"> Edit Product </span>
                        </button>

                        <button type="button mt-5 mb-5 " class="btn btn-outline-danger btn-block flex-nowrap">
                            <i class="fas fa-trash-alt"></i> <span class="d-none d-md-inline-block"> Delete Product </span>
                        </button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<?php } ?>