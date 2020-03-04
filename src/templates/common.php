<?php
function drawHead($jsArray = null)
{ ?>
    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>KeyShare</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
function drawHeader()
{ ?>
    <?php }

function drawNavbar()
{ ?>
    <?php
}

function drawFooter()
{ ?>
    </body>

    </html>
<?php
} ?>