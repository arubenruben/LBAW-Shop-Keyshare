<?php function drawAdminStart()
{ ?>

    <section class="aboutus py-5" id="aboutus">
        <div id="content" class="container-fluid">
            <div class="row">

            <?php } ?>


            <!-- header -->
            <?php function drawHeaderAdmin($type)
            {
                switch ($type) {
                    case 0: ?>
                        <div id="wrapper">
                            <header id="headerFixed" class="navbar row">
                                <div class="col-sm-4 mt-auto mb-auto text-right">
                                <a href="products_list.php" class="btn btn-outline-light mr-5 pl-4 pr-4 navbarButton" role="button">Dashboard</a>
                                </div>
                                <div class="col-sm-4 mt-auto mb-auto text-center">
                                    <img class="img-fluid logo mx-auto" src="../../assets/images/logo/logo.png" />
                                </div>
                                <div class="col-sm-4 mt-auto mb-auto text-left">
                                <a href="products_list.php" class="btn btn-outline-light mr-5 pl-4 pr-4 navbarButton" role="button">Logout</a>
                                </div>


                            </header>
                        <?php
                        break;
                    default: ?>
                    <?php
                        break;
                }?>
                <div class="col-sm-3 col-md-2 mt-5">
                    <h3> Admin Interface (Admin: LockdownPT)</h3>
                    </div>


                    
                <?php
            } ?>


                <?php function drawAdminLogin()
                {
                ?>
                    <div id="wrapper" class="row align-items-center">

                        <div class="col-9 col-sm-8 col-md-5 col-lg-3 mx-auto p-4" style="background-color: white; border-radius: 5px;">

                                <div class="row">
                                    <div class="col text-center mb-4">
                                    <h4> Administrator Login </h4>
                                    </div>
                                </div>
                                    <img class="img-fluid logo " src="../../assets/images/logo/logo.png" />
                            
                          
                                    <form class="form-horizontal mt-5">
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
                </div>
                <?php
                }
                ?>



                <?php function drawAdminInterface()
                { ?>

                    <div class="col-sm-3 col-md-2 mt-4">
                        <div class="card">
                            <div class="">
                                <!-- <h4 class="pl-3 py-2">Categories</h4> -->
                                <ul class="list-unstyled">
                                    <li><a href="" class="list-group-item  bg-active"><i class="fa fa-tachometer"></i> Dashboard </a> </li>
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

                function drawAdminEnd()
                { ?>

                    </div>
                        </div>
            </div>
    </section>

<?php }

                function drawAdminHomePage()
                { ?>

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

                function drawAdminSkeletonTable()
                { ?>

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