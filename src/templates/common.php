<?php
function drawHead($jsArray = null)
{ ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>KeyShare</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="../css/style.css">

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <!--font Sans-Serif-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <!--font Serif-->
        <link href="https://fonts.googleapis.com/css?family=Arvo&display=swap" rel="stylesheet">


        <?php
        if ($jsArray !== null) {
            foreach ($jsArray as $jsFile) { ?>
                <script src=<?= $jsFile ?> defer></script>
        <?php }
        }
        ?>
    </head>

    <body>
    <?php
}
function drawHeader($type)
{
    switch ($type) {
            //Draw Homepage header
        case 0:



            break;




        default:

            break;
    }

    ?>

        <?php }

    function drawNavbar($type)
    {
        switch ($type) {
                //Draw Homepage navbar
            case 0: ?>

                <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
                    <div class="container">
                        <a class="navbar-brand" href="#">Start Bootstrap</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarResponsive">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#">Home
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Services</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Contact</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>


        <?php
                break;


            default:

                break;
        }

        ?>




    <?php
    }

function drawFooter()
    { ?>
        <!-- Footer -->
        <footer>
            <div class="container">
                <br>
                <hr class="style1"> <br>
                <div class="row ">
                    <div class="col-md-6">
                        <h5 class="title"> More </h5>
                        <ul class="list-unstyled">
                            <li>
                                <a href="#"> Contact </a>
                            </li>
                            <li>
                                <a href="#"> FAQs </a>
                            </li>
                            <li>
                                <a href="#"> About us </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-6 d-flex justify-content-end align-items-end">
                        <p>© Copyright 2020 Key Share. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </footer>
    </body>

    </html>
<?php
    } ?>