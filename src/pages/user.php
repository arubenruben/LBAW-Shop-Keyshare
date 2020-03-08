<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_user.php');
    drawHead();
    ?>

    <?php
    drawHeader(0);
    drawNavbar(0);
    ?>
<?php
    drawUserDetails();
    drawFooter();
?>