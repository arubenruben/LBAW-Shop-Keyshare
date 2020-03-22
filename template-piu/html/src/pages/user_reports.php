<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_user.php');

    drawHead();
    drawHeader(0);
    drawNavbar(4,'My Offers«');
    drawUserReports("normal");
    drawFooter();
?>