<?php
    include_once('../templates/tpl_common.php');
    include_once('../templates/tpl_user.php');

    drawHead();
    drawHeader(0);
    drawBreadcrumb('My Offers');
    drawUserOffers();
    drawFooter();
?>